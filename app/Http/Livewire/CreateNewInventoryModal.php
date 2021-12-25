<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Livewire\Component;

class CreateNewInventoryModal extends Component
{
    public $name;
    public $is_active;
    public $created = false;


    protected $rules = [
        'name' => 'required|string|min:4|max:255|unique:inventories,name',
        'is_active' => 'required|boolean'
    ];

    protected $listeners = [
        'pleaseRefresh' => 'resetForm',
        'resetForm' => 'resetForm',
    ];

    public function render()
    {
        return view('livewire.create-new-inventory-modal');
    }

    public function resetForm()
    {
        $this->name = null;
        $this->is_active = null;
        $this->created = null;
        $this->reset('name','is_active','created');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitSelf('$refresh');
        $this->emitTo('inventories','pleaseRefresh');
    }

    public function create()
    {
        $this->validate();

        $newInventory = Inventory::create([
            'name' => $this->name,
            'is_active' => $this->is_active,
        ])->save();

        $this->created = true;

        $this->emitTo('inventories','pleaseRefresh');
    }
}
