<?php

namespace App\Listeners;

use App\AnsibleFileManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * @param  object  $event
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
            'skipped' => 0,
            'rescued' => 0,
            'ignored' => 0,
        ];

        if($runsLog){
            foreach ($runsLog as $item){
                $stats['ok'] += $item['ok'];
                $stats['changed'] += $item['changed'];
                $stats['unreachable'] += $item['unreachable'];
                $stats['skipped'] += $item['skipped'];
                $stats['rescued'] += $item['rescued'];
                $stats['ignored'] += $item['ignored'];
            }
        }

        $play->ok = $stats['ok'];
        $play->changed = $stats['changed'];
        $play->unreachable = $stats['unreachable'];
        $play->skipped = $stats['skipped'];
        $play->rescued = $stats['rescued'];
        $play->ignored = $stats['ignored'];
        $play->save();
    }
}
