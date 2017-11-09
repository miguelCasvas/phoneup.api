<?php

namespace App\Events;

use App\models\Extension;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreacionExtension
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Extension
     */
    public $extension;


    /**
     * CreacionExtension constructor.
     *
     * @param Extension $extension
     */
    public function __construct(Extension $extension)
    {
        //
        $this->extension = $extension;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
