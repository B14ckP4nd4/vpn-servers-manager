<?php

namespace App\Http\Livewire;

use App\Models\InventoryItem;
use Livewire\Component;

class InventoryItemsList extends Component
{
    public $inventoryItems;

    public function render()
    {
        $this->inventoryItems = InventoryItem::orderBy('id','desc')->get();
        return view('livewire.inventory-items-list');
    }

    public function removeItem($id)
    {
//        $this->emit('refreshModal');
        $this->emit('itemSelectedForDelete',$id);
    }

    public function remove($id){
        InventoryItem::findOrFail($id)->delete();
    }
}
