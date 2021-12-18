<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Validation\Rule;
use Livewire\Component;

class InventoryItemsFormModal extends Component
{
    public $toggle = false;
    public $updateMode = false;
    public $Inventories;
    public $updated = false;
    public $created = false;
    public $item_id , $server , $inventory_id;

    protected $listeners = [
        'editItem' => 'SelectItemForEdit',
        'createItem' => 'create',
        'cancel' => 'restart',
    ];

    protected $rules = [
        'inventory_id' => 'required|numeric|exists:inventories,id',
        'server' => 'required|string|unique:inventory_items,server'
    ];

    public function mount()
    {
        $this->Inventories = Inventory::orderBy('id','desc')->get();
    }

    public function render()
    {
        return view('livewire.inventory-items-form-modal');
    }

    public function SelectItemForEdit($id)
    {
        $this->restart();
        $inventory_item = InventoryItem::findOrFail($id);

        $this->item_id = $inventory_item->id;
        $this->server = $inventory_item->server;
        $this->inventory_id = $inventory_item->inventory_id;

        $this->toggle = true;
        $this->updateMode = true;

    }

    public function create()
    {
        $this->restart();
        $this->updateMode = false;
        $this->toggle = true;
    }

    public function addItem()
    {
        $this->validate();

        $newItem = InventoryItem::create([
            'server' => $this->server,
            'inventory_id' => $this->inventory_id,
        ])->save();

        $this->emitTo('inventory-items-list','pleaseRefresh');
        $this->created = true;
    }

    public function updateItem()
    {

        $this->validate([
            'inventory_id' => 'required|numeric|exists:inventories,id',
            'server' => ['required','string',Rule::unique('inventory_items')->ignore($this->item_id)],
            'item_id' => 'required|numeric|exists:inventory_items,id'
        ]);


        $update = InventoryItem::findOrFail($this->item_id)->update([
            'server' => $this->server,
            'inventory_id' => $this->inventory_id,
        ]);

        $this->emitTo('inventory-items-list','pleaseRefresh');
        $this->updated = true;
    }

    public function restart()
    {
        $this->item_id = null;
        $this->server = null;
        $this->inventory_id = null;
        $this->toggle = null;
        $this->updateMode = null;
        $this->updated = false;
        $this->created = false;
    }
}
