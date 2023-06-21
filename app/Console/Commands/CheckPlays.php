<?php

namespace App\Console\Commands;

use App\Events\PlayCompleted;
use App\Models\Play;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class CheckPlays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ansible:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check Current active plays';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    /*
     * plays
     */
    protected $current_plays;


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
        sleep(5);

        $this->current_plays = Redis::get('ansible_plays') ?? json_encode([]);

        $this->current_plays = json_decode($this->current_plays, true);

        $plays = Play::where('is_running',1)->orWhere('is_crashed',1)->get();


        $tableContent = [];
        $i = 1;

        foreach ($plays as $play){

            if(isset($this->current_plays['play_'.$play->id]))
                continue;

            if(!file_exists($play->log_file))
            {
                $play->update([
                    'completed_at' => Carbon::now(),
                    'is_running' => 0,
                    'log_file' => null,
                ]);
                continue;
            }
            preg_match('/^PLAY\sRECAP.*$/mi', file_get_contents($play->log_file), $matches);


            if (!empty($matches)) {
                $play->update([
//                    'completed_at' => Carbon::now(),
                    'is_running' => 0,
                    'is_crashed' => 1,
                ]);

                $play->completed_at = Carbon::now();
                $play->is_running = 0;
                $play->is_crashed = 0;
                $play->save();




                PlayCompleted::dispatch($play);
            }

            $tableContent[] = [
                $i++,
                $play->id,
                $play->inventory()->first()->name,
                0,
                $play->is_running,
                $play->completed_at ?? 0,
                $play->is_crashed,
            ];
        }

        foreach ($this->current_plays as $playItem => $v) {

            $play = Play::find($v['id']);

            if(!$play)
                continue;

            $tableContent[] = [
                $i++,
                $play->id,
                $play->inventory()->first()->name,
                $v['pid'],
                $play->is_running,
                $play->completed_at ?? 0,
                $play->is_crashed,
            ];

            if (file_exists("/proc/" . $v['pid']))
                continue;

            if(!$play){
                unset($this->current_plays[$playItem]);
                Redis::set('ansible_plays',json_encode($this->current_plays));

                continue;
            }

            if(!file_exists($v['log']))
            {
                $play->update([
                    'completed_at' => Carbon::now(),
                    'is_running' => 0,
                    'log_file' => $v['log'],
                ]);
                continue;
            }


            $logFileContent = file_get_contents($v['log']);

            preg_match('/^PLAY\sRECAP.*$/mi', $logFileContent, $matches);


            $play->update([
                'completed_at' => Carbon::now(),
                'is_running' => 0,
                'log_file' => $v['log'],
            ]);


            if (!empty($matches)) {
                PlayCompleted::dispatch($play);
            }
            else
            {
                $this->playIsCrashed($play->id);
            }

            unset($this->current_plays[$playItem]);

            Redis::set('ansible_plays',json_encode($this->current_plays));
        }

        $this->info("List of Running");
        $this->table(
            ['#','ID','Inventory','PID','isRunning?','Completed At','isCrashed?'],
            $tableContent
        );
        return Command::SUCCESS;
    }


    private function playIsCrashed($id)
    {
        $this->warn("Play {$id} has been crashed !");
        $play = Play::find($id);
        $play->is_crashed = 1;
        $play->is_running= 0;
        $play->completed_at= null;
        $play->run_at= null;
        return $play->save();
    }

    private function findPID($keyboard){
        $keyboard = str_replace(config('ansible.play_logs_path'),'',$keyboard);
        $find = exec("ps -ef | awk '/{$keyboard}/{print $2}'");
        return $find;
    }
}
