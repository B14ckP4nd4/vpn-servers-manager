<?php

namespace App\Console\Commands;

use App\AnsibleFileManager;
use App\Models\Inventory;
use Illuminate\Console\Command;

class refreshInventoryFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ansible:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh inventories files';

    /**
     * list of inventory
     */
    protected $inventories;

    /**
     * determine inventories path
     */
    protected $inventories_path;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->inventories = Inventory::orderBy('id','ASC')->get();
        $this->inventories_path = config('ansible.inventories_path');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($this->inventories as $inventory){
            $filename = AnsibleFileManager::clearName($inventory->name , 'ini');
            $inventoryHosts = $inventory->items()->get()->pluck('server')->toArray();
//            $inventoryVariables = $inventory->vars();
        }
        return Command::SUCCESS;
    }


}
