<?php

namespace App\Http\Livewire;

use App\Models\Play;
use Livewire\Component;

class ReplayPlay extends Component
{
    public $selected;
    public $replayed = false;

    protected $listeners = [
        'pleaseRefresh' => 'resetModal',
        'selectForReplay' => 'select'
    ];

    public function render()
    {
        return view('livewire.replay-play');
    }

    public function select($id)
    {
        $this->resetModal();
        $play = Play::findOrFail($id);
        $this->selected = $play->id;
    }

    public function resetModal()
    {
        $this->selected = null;
        $this->replayed = false;
    }

    public function Play()
    {
        $play = Play::findOrFail($this->selected);
        $play->run_at = null;
        $play->completed_at = null;
        $play->is_crashed = 0;
        $play->save();

        $this->resetModal();
        $this->replayed = true;
        $this->emitTo('plays','pleaseRefresh');
    }
}
