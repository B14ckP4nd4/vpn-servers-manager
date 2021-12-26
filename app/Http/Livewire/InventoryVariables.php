<?php

namespace App\Http\Livewire;

use App\Models\InventoryVar;
use Livewire\Component;

class InventoryVariables extends Component
{
    public $vars;
    public $sort_server = true;

    protected $listeners = [
        'pleaseRefresh' => '$refresh'
    ];

    public function render()
    {
        if($this->sort_server)
        {
            $this->vars = InventoryVar::orderBy('inventory_id','desc')->get();
        }
        else
        {
            $this->vars = InventoryVar::orderBy('id','desc')->get();
        }
        return view('livewire.inventory-variables');
    }
}
