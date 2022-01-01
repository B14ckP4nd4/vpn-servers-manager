<?php

namespace App\Console\Commands;

use App\AnsibleFileManager;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class refreshInventoryFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ansible:refresh {inventory?*}';

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // set Data we need to get inventories
        if($this->arguments()['inventory']){
            $this->inventories = Inventory::whereIn('id',$this->arguments()['inventory'])->get();
        }
        else
        {
            $this->inventories = Inventory::orderBy('id','ASC')->get();
        }

        $this->inventories_path = config('ansible.inventories_path');


        foreach ($this->inventories as $inventory){

            $filename = AnsibleFileManager::clearName($inventory->name , 'ini');
            $inventoryHosts = $inventory->items()->get();
            $inventoryVariables = $inventory->vars()->get()->toArray();

            if(file_exists($this->inventories_path . $filename))
            {
                // ignore if inventory items and vars didnt have any change
                if( !$this->hasVarChanges($inventory) && !$this->hasHostsChanges($inventory))
                    continue;
            }

            // ignore if inventory hasn't any host
            if($inventory->items()->count() == 0)
                continue;



            // set SSH vars
            $ansibleUserName = $this->searchInArrayForKey($inventoryVariables , 'name', 'ansible_user');
            $ansiblePrivateKey = $this->searchInArrayForKey($inventoryVariables, 'name', 'ansible_ssh_private_key_file');
            if(empty($ansibleUserName) && empty($ansiblePrivateKey)){
                $inventoryVariables = array_merge($inventoryVariables,[
                    [
                        'name' => 'ansible_user',
                        'val' => config('ansible.default_username')
                    ],
                    [
                        'name' => 'ansible_password',
                        'val' => config('ansible.default_password')
                    ],
                    [
                        'name' => 'ansible_ssh_private_key_file',
                        'val' => config('ansible.private_key')
                    ],
                ]);
            }

            // generate inventory file Content
            $content = AnsibleFileManager::generateInventoryFile($inventoryHosts , $inventoryVariables);

            $savedFile = AnsibleFileManager::saveFile($filename, $this->inventories_path, $content);

            $inventory->last_refresh = date('Y-m-d H:i:s');
            $inventory->save();


        }
        return Command::SUCCESS;
    }

    private function searchInArrayForKey($array, $key, $value){
        $results = array();


        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, $this->searchInArrayForKey($subarray, $key, $value));
            }
        }

        return $results;
    }

    /**
     * check the inventory variables has anyChange after last refresh or not
     * @param Inventory $inventory
     * @return bool
     */
    private function hasVarChanges(Inventory $inventory){

        if(!$inventory->last_refresh)
            return true;

        $vars = $inventory->vars()->where('created_at','>=',$inventory->last_refresh)
            ->orWhere('updated_at','>=',$inventory->last_refresh)->count();

        return ($vars > 0);
    }


    /**
     * check the inventory Items has anyChange after last refresh or not
     * @param Inventory $inventory
     * @return bool
     */
    private function hasHostsChanges(Inventory $inventory){

        if(!$inventory->last_refresh)
            return true;

        $hosts = $inventory->items()->where('created_at','>=',$inventory->last_refresh)
            ->orWhere('updated_at','>',$inventory->last_refresh)->count();

        return ($hosts > 0);
    }


}
