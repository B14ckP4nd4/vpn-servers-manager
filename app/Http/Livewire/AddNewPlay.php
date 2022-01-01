<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use App\Models\Play;
use Livewire\Component;

class AddNewPlay extends Component
{
    public $inventories, $playBooks;
    public $inventory_id, $playbook_id;
    public $created = false;

    protected $rules = [
        'inventory_id' => 'required|numeric|exists:inventories,id',
        'playbook_id' => 'required|numeric|exists:playbooks,id',
    ];

    protected $listeners = [
        'pleaseRefresh' => '$refresh'
    ];

    public function render()
    {
        $this->inventories = Inventory::has('items')->orderBy('id','desc')->get();
        $this->playBooks = \App\Models\PlayBooks::orderBy('id','desc')->get();
        return view('livewire.add-new-play');
    }

    public function create()
    {
        $this->validate();

        $newPlay = Play::create([
            'inventory_id' => $this->inventory_id,
            'playbook_id' => $this->playbook_id,
        ]);

        $newPlay->save();

        $this->emitSelf('pleaseRefresh');
        $this->emitTo('plays','pleaseRefresh');
        $this->created = true;

    }

    public function resetForm()
    {
        $this->reset('inventory_id','playbook_id','created');
        $this->created = false;
        $this->inventory_id = null;
        $this->playbook_id = null;
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
