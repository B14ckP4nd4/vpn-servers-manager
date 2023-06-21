<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Validation\Rule;
use Livewire\Component;

class GroupAddItem extends Component
{
    public $toggle = false;
    public $Inventories;
    public $created = false;
    public $item_id , $servers , $inventory_id;

    protected $listeners = [
        'createItem' => 'create',
        'cancel' => 'restart',
    ];

    protected $rules = [
        'inventory_id' => 'required|numeric|exists:inventories,id',
        'servers' => 'required|string'
    ];

    public function mount()
    {
        $this->Inventories = Inventory::orderBy('id','desc')->get();
    }

    public function render()
    {
        return view('livewire.group-add-item');
    }

    public function create()
    {
        $this->restart();
        $this->toggle = true;
    }

    public function addItem()
    {
//        $this->validate();
        $this->servers = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $this->servers);
        preg_match_all('/\s?(?<ip>\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})\s?/i', $this->servers, $matches);
        foreach ($matches['ip'] as $ip){
            if(!InventoryItem::where('server',$ip)->first()){
                $newItem = InventoryItem::create([
                    'server' => trim($ip),
                    'inventory_id' => $this->inventory_id,
                ])->save();

                $this->servers = str_replace($ip,"",$this->servers);
            }

        }
        $this->servers = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $this->servers);
        $this->servers = trim($this->servers);

        if(!empty($this->servers))
        {
            $this->addError('server', 'some servers are duplicate or wrong');
            $this->created = false;
        }
        else
        {
            $this->created = true;
        }

        $this->emitTo('inventory-items-list','pleaseRefresh');
    }

    public function restart()
    {
        $this->item_id = null;
        $this->servers = null;
        $this->inventory_id = null;
        $this->toggle = null;
        $this->created = false;
    }
}
