<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\InventoryVar;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditInventoryVar extends Component
{
    public $selected , $name , $val, $inventory_id;
    public $updated = false;
    public $Inventories = [];

    protected $listeners = [
        'pleaseRefresh' => 'resetForm',
        'selectForEdit' => 'select'
    ];

    public function render()
    {
        $this->Inventories = Inventory::orderBy('id','desc')->get();
        return view('livewire.edit-inventory-var');
    }

    public function select($id)
    {
        $this->resetForm();
        $inventoryVar = InventoryVar::findOrFail($id);
        $this->selected = $inventoryVar->id;
        $this->name = $inventoryVar->name;
        $this->val = $inventoryVar->val;
        $this->inventory_id = $inventoryVar->inventory()->first()->id;
    }

    public function resetForm()
    {
        $this->selected = null;
        $this->name = null;
        $this->val = null;
        $this->inventory_id = null;
        $this->reset('selected','name','val','inventory_id');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitSelf('$refresh');
        $this->emitTo('inventory-variables','pleaseRefresh');
    }

    public function update()
    {
        $this->validate([
            'name' => ['required','string','max:255'],
            'val' => 'required|string|max:255',
            'inventory_id' => 'required|numeric|exists:inventories,id'
        ]);

        $inventory = InventoryVar::findOrFail($this->selected)->update([
            'name' => $this->name,
            'val' => $this->val,
            'inventory_id' => $this->inventory_id
        ]);
        $this->resetForm();
        $this->updated = true;
    }
}
