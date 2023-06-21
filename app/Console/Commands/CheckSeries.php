<?php

namespace App\Console\Commands;

use App\Models\Inventory;
use App\Models\Play;
use App\Models\Series;
use Illuminate\Console\Command;

class CheckSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'series:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check Series Plays';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $series = Series::whereIn('status', ['created', 'running'])->get();

        foreach ($series as $serie) {

            $playQueue = json_decode($serie->series, true);


            if ($serie->status == 'created') {

                foreach ($playQueue as $k => $queue) {
                    $newPlay = Play::create([
                        'inventory_id' => $serie->inventory_id,
                        'playbook_id' => $queue['playbook']
                    ]);

                    $queue['play_id'] = $newPlay->id;
                    $queue['status'] = 'running';
                    $playQueue[$k] = $queue;
                    break;
                }
                $serie->status = 'running';

                $this->saveSeries($serie, $playQueue);

                continue;
            }

            if ($serie->status == 'running') {
                $completes = 0;
                foreach ($playQueue as $k => $queue) {
                    if (isset($queue['play_id']) && $queue['status'] == 'running') {

                        $play = Play::find($queue['play_id']);

                        if (!$play->completed_at)
                            break;


                        if ($play->completed_at) {
                            $queue['status'] = 'completed';
                            $playQueue[$k] = $queue;
                            break;
                        }
                    }

                    if ($queue['status'] == 'completed') {
                        $completes += 1;
                    }

                    if ($queue['status'] == 'pending') {
                        $newPlay = Play::create([
                            'inventory_id' => $serie->inventory_id,
                            'playbook_id' => $queue['playbook']
                        ]);
                        $queue['play_id'] = $newPlay->id;
                        $queue['status'] = 'running';
                        $playQueue[$k] = $queue;
                        break;
                    }
                }

                if (count($playQueue) == $completes) {
                    $serie->status = 'completed';
                    foreach (Inventory::find($serie->inventory_id)->items()->get() as $inventoryItem){
                        $inventoryItem->delete();
                    }
                }
            }

            $this->saveSeries($serie, $playQueue);
        }
    }

    private function saveSeries(Series $series, $queue)
    {
        $series->series = json_encode($queue);
        return $series->save();
    }
}
