<?php

namespace App\Http\Livewire;

use App\AnsibleFileManager;
use App\Models\Play;
use Livewire\Component;

class PlayLogs extends Component
{
    public $play_id , $logs;

    protected $listeners = [
      'pleaseRefresh' => '$refresh',
      'getLogs' => 'getLogs',
    ];
    public function render()
    {
        return view('livewire.play-logs');
    }

    public function getLogs($play_id)
    {
        $play = Play::findOrFail($play_id);
        $this->logs = ( AnsibleFileManager::loadFile($play->log_file) ) ? AnsibleFileManager::loadFile($play->log_file) : "Logs Are Removed !";
        $this->logs = str_replace('\n',"&#10;",$this->logs);
//        $this->logs = str_replace('\t'," ",$this->logs);
    }
}
