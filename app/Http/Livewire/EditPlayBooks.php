<?php

namespace App\Http\Livewire;

use App\Events\PlayBookAdded;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditPlayBooks extends Component
{
    public $selected, $name, $url, $path;
    public $updated = false;

    protected $listeners = [
        'pleaseRefresh' => '$refresh',
        'selectForEdit' => 'select'
    ];

    public function render()
    {
        return view('livewire.edit-play-books');
    }

    public function select($id)
    {
        $this->resetForm();
        $playBook = \App\Models\PlayBooks::findOrFail($id);
        $this->name = $playBook->name;
        $this->selected = $playBook->id;
        $this->url = $playBook->url;
        $this->path = $playBook->path;
    }

    public function resetForm()
    {
        $this->selected = $this->name = $this->url = $this->path = null;
        $this->updated = false;
        $this->reset('selected','name','url','path');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emitSelf('pleaseRefresh');
        $this->emitTo('playbooks','pleaseRefresh');
    }

    public function update()
    {
        $this->validate([
            'name' => ['required','string','min:4','max:255',Rule::unique('playbooks')->ignore($this->selected)],
            'url' => ['required','string','min:4','max:255',Rule::unique('playbooks')->ignore($this->selected)],
        ]);

        $playBook = \App\Models\PlayBooks::findOrFail($this->selected)->update([
            'name' => $this->name,
            'url' => $this->url,
        ]);

        PlayBookAdded::dispatch(\App\Models\PlayBooks::findOrFail($this->selected));

        $this->resetForm();

        $this->updated = true;

        return redirect()->to(route('dashboard.playbooks'));
    }


}
