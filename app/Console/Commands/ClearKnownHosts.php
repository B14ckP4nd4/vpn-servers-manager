<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearKnownHosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:known-hosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear SSH Known Hosts';

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
        /*
         * path of known hosts
         */
        $knownHosts = "/root/.ssh/known_hosts";

        /*
         * set value for rewrite new content
         */
        $newContent = '';

        /*
         * get known hosts file contents
         */
        $knownHostsContent = file_get_contents($knownHosts);

        /*
         * search for hosts
         */
        $checkHosts = preg_match_all('/^(?<ip>[\S]+)\s+[\S]+\s+[\S]+$/mi',$knownHostsContent,$matches);

        /*
         * if find any matches remove everything except the localhost key
         */
        if(isset($matches['ip'])){
            $localhost = array_search('localhost', $matches['ip']);

            if($localhost !== false){
                $newContent .= $matches[0][$localhost];
            }

            file_put_contents($knownHosts,$newContent);
        }
        return Command::SUCCESS;
    }
}
