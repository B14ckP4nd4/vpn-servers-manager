<?php

namespace App\Events;

use App\Models\PlayBooks;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayBookAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $playbook;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PlayBooks $playbook)
    {
        $this->playbook = $playbook;
    }

}
