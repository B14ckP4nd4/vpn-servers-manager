<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RemovePlayBook extends Component
{
    public $selected;
    public $removed;

    protected $listeners = [
        'pleaseRefresh' => 'resetModal',
        'selectForRemove' => 'select'
    ];

    public function render()
    {
        return view('livewire.remove-play-book');
    }

    public function select($id)
    {
        $this->resetModal();
        $playbook = \App\Models\PlayBooks::findOrFail($id);
        $this->selected = $playbook->id;
    }

    public function remove()
    {
        $inventoryVar = \App\Models\PlayBooks::findOrFail($this->selected)->delete();
        $this->resetModal();
        $this->removed = true;
        $this->emitTo('playbooks','pleaseRefresh');
    }

    public function resetModal()
    {
        $this->selected = null;
        $this->removed = false;
    }
}
