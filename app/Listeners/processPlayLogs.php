<?php

namespace App\Listeners;

use App\AnsibleFileManager;
use App\Models\InventoryItem;
use App\Models\Play;
use Illuminate\Support\Facades\Artisan;

class processPlayLogs
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $play = $event->play;
        $content = AnsibleFileManager::loadFile($event->play->log_file);
        $runsLog = AnsibleFileManager::parsePlayLog($content);

        $stats = [
            'ok' => 0,
            'changed' => 0,
            'unreachable' => 0,
            'failed' => 0,
            'skipped' => 0,
            'rescued' => 0,
            'ignored' => 0,
        ];

        if ($runsLog) {
            foreach ($runsLog as $id => $value) {
                $stats['ok'] += $value['ok'];
                $stats['changed'] += $value['changed'];
                $stats['unreachable'] += $value['unreachable'];
                $stats['failed'] += $value['failed'];
                $stats['skipped'] += $value['skipped'];
                $stats['rescued'] += $value['rescued'];
                $stats['ignored'] += $value['ignored'];
                if ($value['failed'] == 0 && $stats['unreachable'] == 0) {

//                    $inventoryItem = InventoryItem::where([
//                        ['inventory_id', '=', $play->inventory()->first()->id],
//                        ['server', '=', $value['host']],
//                    ])->delete();

                    Artisan::call('ansible:refresh', [
                        'inventory' => $play->inventory()->first(),
                    ]);
                    $server_ip = false;

                    if($event->play->inventory()->first()->items()->first())
                        $server_ip = $event->play->inventory()->first()->items()->first()->server;

                    $playbook = $event->play->playbook()->first()->name;

                    if($server_ip)
                        update_last_play($server_ip,$playbook);
                }
                else
                {
                    $this->playIsCrashed($play->id);
                }
            }
        }

        $play->ok = $stats['ok'];
        $play->changed = $stats['changed'];
        $play->unreachable = $stats['unreachable'];
        $play->failed = $stats['failed'];
        $play->skipped = $stats['skipped'];
        $play->rescued = $stats['rescued'];
        $play->ignored = $stats['ignored'];
        $play->save();
    }

    private function playIsCrashed($id)
    {
        $play = Play::find($id);
        $play->is_crashed = 1;
        $play->is_running= 0;
        $play->completed_at= null;
        $play->run_at= null;
        return $play->save();
    }
}
