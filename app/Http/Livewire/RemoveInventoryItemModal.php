<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use Livewire\Component;

class RemoveInventoryItemModal extends Component
{
    public $itemID = null;
    protected $listeners = [
        'itemSelectedForDelete' => 'setItemID',
        'refreshModal' => 'refreshModal'
    ];

    public function render()
    {
        return view('livewire.remove-inventory-item-modal');
    }

    public function setItemID($id){
        $this->itemID = $id;
    }

    public function refreshModal(){
        $this->itemID = null;
    }

    public function remove($id)
    {
        InventoryItem::findOrFail($id)->delete();
        $this->refreshModal();
        $this->emit('itemRemoved');
    }
}
