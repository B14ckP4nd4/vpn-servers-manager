<?php

namespace App\Console\Commands;

use App\AnsibleFileManager;
use App\Events\PlayCompleted;
use App\Models\Play;
use Asm\Ansible\Ansible;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Process\Process;

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
    protected $description = 'Command description';

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
        $ansible = new Ansible(config('ansible.default_path'));
        $logPath = config('ansible.play_logs_path');

        $plays = Play::pending()->get();
        foreach ($plays as $play) {
            $logFileName = AnsibleFileManager::clearName($play->id . '_' . date('Y-m-d_H-i-s'), 'log');
            $logFile = AnsibleFileManager::saveFile($logFileName, $logPath, "");

            $play->update([
                'log_file' => $logFile,
                'run_at' => Carbon::now(),
                'is_running' => 1,
            ]);


            $run = $ansible->playbook()
                ->play($play->playbook()->first()->path)
                ->inventoryFile($play->inventory()->first()->path)
                ->hostKeyChecking(false)
                ->verbose()
                ->execute();


            $logFile = AnsibleFileManager::saveFile($logFile, null, $run);

            $play->update([
                'completed_at' => Carbon::now(),
                'is_running' => 0,
                'log_file' => $logFile,
            ]);

            PlayCompleted::dispatch($play);
        }

        return Command::SUCCESS;
    }
}
