<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Series extends Component
{
    public $series;
    public function render()
    {
        $this->series = \App\Models\Series::orderBy('id','desc')->get();
        return view('livewire.series');
    }
}
