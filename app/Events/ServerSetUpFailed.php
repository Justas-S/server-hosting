<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Server;

class ServerSetUpFailed
{
    use InteractsWithSockets, SerializesModels;

    private $msg;
    private $server;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Server $server, $msg)
    {
        $this->server = $server;
        $this->msg = $msg;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('server.'.$this->server->user_id);
    }
}
