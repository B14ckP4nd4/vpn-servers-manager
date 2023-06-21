<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Illuminate\Support\Collection;
use Livewire\Component;

class AddNewSeries extends Component
{
    public $inventories;
    public $playBooks;

    public $inventory_id;
    public $created = 0;
    public $selected_playbook;

    public $series;

    protected $rules = [
        'inventory_id' => 'required|numeric|exists:inventories,id',
    ];


    protected $listeners = [
        'pleaseRefresh' => '$refresh'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->series = new Collection();
    }

    public function render()
    {
        $this->inventories = Inventory::has('items')->orderBy('id','desc')->get();
        $this->playBooks = \App\Models\PlayBooks::orderBy('id','desc')->get();
        return view('livewire.add-new-series');
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function save()
    {
        $this->validate();

        \App\Models\Series::create([
            'inventory_id' => $this->inventory_id,
            'series' => $this->series->toJson(),
            'status' => 'created',
        ]);

        $this->reset();
        $this->created = 1;
    }

    public function addPlayBook()
    {
        if(!$this->selected_playbook)
            return false;

        $this->series->add([
            'order' => $this->selected_playbook,
            'playbook' => $this->selected_playbook,
            'title' => \App\Models\PlayBooks::find($this->selected_playbook)->name,
            'status' => 'pending',
        ]);

        unset($this->selected_playbook);
    }

    public function resetPlayBooks()
    {
        $this->series = new Collection;
    }
}
