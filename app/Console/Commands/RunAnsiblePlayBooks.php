<?php

namespace App\Console\Commands;

use App\AnsibleFileManager;
use App\Models\Play;
use Asm\Ansible\Ansible;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

set_time_limit(0);

class RunAnsiblePlayBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ansible:play {play?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run playBooks';

    /*
     * plays
     */
    protected $current_plays;


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
        $logPath = config('ansible.play_logs_path');

        $plays = Play::pending()->get();

        foreach ($plays as $play) {

            $this->current_plays = Redis::get('ansible_plays') ?? json_encode([]);

            $this->current_plays = json_decode($this->current_plays, true);

            if(Play::where('is_running',1)->count() >= 5)
                return $this->info('Maximum running Process');

            if($play->is_crashed)
                continue;

            $logFileName = AnsibleFileManager::clearName($play->id . '_' . date('Y-m-d_H-i-s'), 'log');
            $logFile = AnsibleFileManager::saveFile($logFileName, $logPath, "");


            $play->update([
                'log_file' => $logFile,
                'run_at' => Carbon::now(),
                'is_running' => 1,
                'ok' => 0,
                'changed' => 0,
                'unreachable' => 0,
                'failed' => 0,
                'skipped' => 0,
                'rescued' => 0,
                'ignored' => 0,
            ]);

            $command = "ansible-playbook -i {$play->inventory()->first()->path} {$play->playbook()->first()->path} >> $logFile";

            $command = $command . ' & echo $!; ';

//            dd($command);

            $pid = exec($command, $output, $status);

            file_put_contents($logFile, "\n PID: {$pid}\n",FILE_APPEND);
            file_put_contents($logFile, $command . "\n",FILE_APPEND);

            $this->current_plays['play_' . $play->id] = [
                'id' => $play->id ,
                'pid' => $pid,
                'log' => $logFile,
            ];
            $this->current_plays = json_encode($this->current_plays);

            sleep(1);

            Redis::set('ansible_plays', $this->current_plays);
        }



        return Command::SUCCESS;
    }
}
