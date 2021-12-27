<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Playbooks extends Component
{
    public $playBooks;


    protected $listeners = [
        'pleaseRefresh' => '$refresh',
    ];

    public function render()
    {
        $this->playBooks = \App\Models\PlayBooks::orderBy('id','desc')->get();

        return view('livewire.playbooks');
    }
}
