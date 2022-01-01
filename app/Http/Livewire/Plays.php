<?php

namespace App\Http\Livewire;

use App\Models\Play;
use Livewire\Component;

class Plays extends Component
{
    public $plays;

    protected $listeners = [
        'pleaseRefresh' => '$refresh'
    ];

    public function render()
    {
        $this->plays = Play::orderBy('id','desc')->get();
        return view('livewire.plays');
    }
}
