<?php

namespace App\Console\Commands;

use App\Events\PlayBookAdded;
use App\Models\PlayBooks;
use Illuminate\Console\Command;

class UpdatePlayBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'playbooks:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update PlayBooks';

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
        $playBooks = PlayBooks::all();
        foreach ($playBooks as $playBook){
            @unlink($playBook->path);
            PlayBookAdded::dispatch($playBook);
        }
        return Command::SUCCESS;
    }
}
