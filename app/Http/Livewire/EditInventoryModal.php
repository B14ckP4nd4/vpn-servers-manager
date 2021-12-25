<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditInventoryModal extends Component
{
    public $selected_id , $name , $is_active;
    public $is_updated = false;


    protected $listeners = [
        'pleaseRefresh' => 'resetForm',
        'selectInvForEdit' => 'selectID'
    ];

    public function render()
    {
        return view('livewire.edit-inventory-modal');
    }

    public function selectID($id)
    {
        $this->resetForm();
        $inventory = Inventory::findOrFail($id);
        $this->selected_id = $inventory->id;
        $this->name = $inventory->name;
        $this->is_active = $inventory->is_active;
    }

    public function resetForm()
    {
        $this->selected_id = null;
        $this->name = null;
        $this->is_active = null;
        $this->is_updated = null;
        $this->reset('name','is_active','is_updated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitSelf('$refresh');
        $this->emitTo('inventories','pleaseRefresh');
    }

    public function update()
    {
        $this->validate([
            'name' => ['required','string','min:4','max:255',Rule::unique('inventories')->ignore($this->selected_id)],
            'is_active' => 'required|boolean'
        ]);

        $inventory = Inventory::findOrFail($this->selected_id)->update([
            'name' => $this->name,
            'is_active' => $this->is_active
        ]);
        $this->resetForm();
        $this->is_updated = true;
    }
}
