<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\GameServer;

class GameServerPluginInstallEvent
{
    use InteractsWithSockets, SerializesModels;

    public $gameserver;

    public $plugins;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GameServer $gameserver, \Illuminate\Support\Collection $plugins)
    {
        $this->gameserver = $gameserver;
        $this->plugins = $plugins;
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
