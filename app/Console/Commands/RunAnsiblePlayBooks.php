<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $logPath = config('ansible.play_logs_path');

        return Command::SUCCESS;
    }
}
