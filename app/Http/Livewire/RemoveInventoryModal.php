<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Livewire\Component;

class RemoveInventoryModal extends Component
{
    public $selected_id;
    public $deleted = false;

    protected $listeners = [
        'pleaseRefresh' => 'resetModal',
        'selectForRemove' => 'setID'
    ];

    public function render()
    {
        return view('livewire.remove-inventory-modal');
    }

    public function resetModal()
    {
        $this->selected_id = null;
        $this->deleted = false;
        $this->emitSelf('$refresh');
        $this->emitTo('inventories','pleaseRefresh');
    }

    public function setID($id)
    {
        $this->selected_id = $id;
    }

    public function destroy()
    {
        $remove = Inventory::findOrFail($this->selected_id)->delete();
        $this->deleted = true;
        $this->emitTo('inventories','pleaseRefresh');
    }
}
