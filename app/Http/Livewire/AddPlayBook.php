<?php

namespace App\Http\Livewire;

use App\Events\PlayBookAdded;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddPlayBook extends Component
{
    public $name, $url;
    public $created = false;

    protected $listeners = [
        'pleaseRefresh' => '$refresh',
        'resetForm' => 'resetForm'
    ];

    public function render()
    {
        return view('livewire.add-play-book');
    }

    public function resetForm()
    {
        $this->name = $this->url = null;
        $this->created = false;
        $this->reset('name','url');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitSelf('pleaseRefresh');
        $this->emitTo('playbooks','pleaseRefresh');
    }

    public function create()
    {
        $this->validate([
            'name' => ['required','string','min:4','max:255',Rule::unique('playbooks')],
            'url' => ['required','url',Rule::unique('playbooks')],
        ]);

        $newPlayBook = \App\Models\PlayBooks::create([
            'name' => $this->name,
            'url' => $this->url,
        ]);

        $newPlayBook->save();

        PlayBookAdded::dispatch($newPlayBook);

        $this->resetForm();
        $this->created = true;
    }


}
