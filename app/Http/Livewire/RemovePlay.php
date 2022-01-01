<?php

namespace App\Http\Livewire;

use App\Models\Play;
use Livewire\Component;

class RemovePlay extends Component
{
    public function render()
    {
        return view('livewire.remove-play');
    }
    public $selected;
    public $removed = false;

    protected $listeners = [
        'pleaseRefresh' => 'resetModal',
        'selectForRemove' => 'select'
    ];

    public function select($id)
    {
        $this->resetModal();
        $inventoryVar = Play::findOrFail($id);
        $this->selected = $inventoryVar->id;
    }

    public function remove()
    {
        $inventoryVar = Play::findOrFail($this->selected)->delete();
        $this->resetModal();
        $this->removed = true;
        $this->emitTo('plays','pleaseRefresh');
    }

    public function resetModal()
    {
        $this->selected = null;
        $this->removed = false;
    }

}
