<?php

namespace App\Console\Commands;

use App\Models\Play;
use Illuminate\Console\Command;

class rePreparePlay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ansible:prepare';

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
        $plays = Play::where('is_running',0)->get();
        return 0;
        foreach ($plays as $play)
        {
            if($play->is_crashed) {
                $this->warn("Play {$play->id} has been crashed !");
                $play->is_crashed = 0;
                $play->is_running= 0;
                $play->completed_at= null;
                $play->run_at= null;
                $play->save();
                continue;
            }

            if(!$play->inventory()->first()->items()->first())
                continue;

            Play::where([
                ['inventory_id', '=',$play->inventory()->first()->id],
                ['is_running','=',0],
                ['id','!=',$play->id],
            ])->delete();

            $play->run_at = null;
            $play->completed_at = null;
            $play->save();
        }
        return Command::SUCCESS;
    }
}
