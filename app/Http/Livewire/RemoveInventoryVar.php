<?php

namespace App\Http\Livewire;

use App\Models\InventoryVar;
use Livewire\Component;

class RemoveInventoryVar extends Component
{
    public $selected;
    public $removed = false;

    protected $listeners = [
        'pleaseRefresh' => 'resetModal',
        'selectForRemove' => 'select'
    ];

    public function render()
    {
        return view('livewire.remove-inventory-var');
    }

    public function select($id)
    {
        $this->resetModal();
        $inventoryVar = InventoryVar::findOrFail($id);
        $this->selected = $inventoryVar->id;
    }

    public function remove()
    {
        $inventoryVar = InventoryVar::findOrFail($this->selected)->delete();
        $this->resetModal();
        $this->removed = true;
        $this->emitTo('inventory-variables','pleaseRefresh');
    }

    public function resetModal()
    {
        $this->selected = null;
        $this->removed = false;
    }

}
