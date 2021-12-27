<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Livewire\Component;

class NewInventoryModal extends Component
{
    public $resultMessage = null;

    public $name;
    public $is_active;

    protected $rules = [
        'name' => 'required|string|min:4|max:255|unique:inventories,name',
        'is_active' => 'required|boolean'
    ];

    public function render()
    {
        return view('livewire.new-inventory-modal');
    }

    public function submit(){
        $this->validate();

        Inventory::create([
            'name' => $this->name,
            'is_active' => $this->is_active,
        ]);

        $this->resultMessage = "The <span class='strong'>{$this->name}</span> Inventory has been Created Successfully";
    }
}
