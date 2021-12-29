<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\InventoryVar;
use Livewire\Component;

class CreateInventoryVar extends Component
{
    public $name , $val, $inventory_id;
    public $created = false;
    public $Inventories = [];

    protected $listeners = [
        'pleaseRefresh' => 'resetForm',
        'selectForEdit' => 'select'
    ];

    public function render()
    {
        $this->Inventories = Inventory::orderBy('id','desc')->get();
        return view('livewire.create-inventory-var');
    }

    public function resetForm()
    {
        $this->name = null;
        $this->val = null;
        $this->inventory_id = null;
        $this->created = null;
        $this->reset('name','val','inventory_id');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitTo('inventory-variables','pleaseRefresh');
    }

    public function create()
    {
        $this->validate([
            'name' => ['required','string','max:255'],
            'val' => 'required|string|max:255',
            'inventory_id' => 'required|numeric|exists:inventories,id'
        ]);

        $inventoryVar = InventoryVar::create([
            'name' => $this->name,
            'val' => $this->val,
            'inventory_id' => $this->inventory_id
        ]);
        $inventoryVar->save();

        $this->resetForm();
        $this->created = true;
    }

}
