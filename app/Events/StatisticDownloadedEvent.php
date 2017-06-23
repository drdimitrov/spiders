<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StatisticDownloadedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;
    public $place;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, $place)
    {
        $this->type = $type;
        $this->place = $place;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('user-download');
    // }
}
