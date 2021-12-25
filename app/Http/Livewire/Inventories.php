<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Livewire\Component;

class Inventories extends Component
{
    public $inventories, $name,$is_active,$selectedInventory,$resultMessage;

    public $updateMode = false;
    public $deleteModal = false;
    public $editModal = false;
    public $createModal = false;

    protected $listeners = [
        'pleaseRefresh' => '$refresh'
    ];

    protected $rules = [
        'name' => 'required|string|min:4|max:255|unique:inventories,name',
        'is_active' => 'required|boolean'
    ];

    public function render()
    {
        $this->refreshRecords();
        return view('livewire.inventories');
    }

    public function store(){
        $this->validate();

        Inventory::create([
            'name' => $this->name,
            'is_active' => $this->is_active,
        ]);

        $this->resultMessage = "The <span class='strong'>{$this->name}</span> Inventory has been Created Successfully";
        $this->resetInputs();
    }

    public function edit($id){
        $inventory = Inventory::findOrFail($id);
        $this->selectedInventory = $inventory->id;
        $this->name = $inventory->name;
        $this->is_active = $inventory->is_active;
        $this->updateMode = true;
        $this->editModal = true;

    }

    public function update(){
        $this->validate(array_merge($this->rules,[
            'selectedInventory' => 'required|numeric|exists:inventories,id'
        ]));

        if($this->selectedInventory){
            $inventory = Inventory::findOrFail($this->selectedInventory);
            $inventory->update([
                'name' => $this->name,
                'is_active' => $this->is_active,
            ]);
            $inventory->save();
            $this->resetInputs();
            $this->resetSelected();
            $this->updateMode = false;
        }
        $this->resetModals();
    }

    public function destroy()
    {
        $inventory = Inventory::findOrFail($this->selectedInventory)->delete();
        $this->resetModals();
        $this->resetSelected();
    }

    public function create()
    {
        $this->updateMode = false;
        $this->createModal = true;
        $this->resetInputs();
    }

    public function selectInventory($id)
    {
        $this->selectedInventory = $id;
    }
    public function selectInventoryToDelete($id)
    {
        $this->selectedInventory = $id;
        $this->deleteModal = true;
    }

    public function cancelUpdate(){
        $this->resetSelected();
        $this->resetInputs();
        $this->updateMode = false;
        $this->resetModals();
    }

    public function resetSelected()
    {
        $this->selectedInventory = null;
    }

    private function resetInputs()
    {
        $this->name = null;
        $this->is_active = null;
    }

    public function refreshRecords(){
        $this->inventories = Inventory::orderBy('id','desc')->get();
    }

    public function resetModals(){
        $this->editModal = false;
        $this->deleteModal = false;
        $this->createModal = false;
    }
}
