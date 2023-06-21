<?php

namespace App\Console\Commands;

use App\Models\Play;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class stopAllPlays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ansible:stop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop all running PlayBooks';

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
        exec("kill $(ps aux | grep 'openvpn.yml' | awk '{print $2}')");
        Redis::set('ansible_plays', json_encode([]));
        Play::where('is_running',1)->update(['is_crashed' => 1]);
    }
}
