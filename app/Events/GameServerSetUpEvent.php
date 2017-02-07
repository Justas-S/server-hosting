<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\GameServer;
use App\Database;
use App\DatabaseUser;
use App\FtpUser;

class GameServerSetUpEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var App\GameServer
     */
    protected $gameserver;

    /**
     * @var App\Database
     */
    protected $database;

    /**
     * @var App\DatabaseUser
     */
    protected $db_user;

    /**
     * @var App\FtpUser
     */
    protected $ftp_user;


    /**
     * Create a new event instance.
     *
     * @param App\GameServer
     * @param db string
     * @param db_user App\DatabaseUser
     * @param ftp_user App\FtpUser
     * @return void
     */
    public function __construct(GameServer $gameserver, Database $db, DatabaseUser $db_user, FtpUser $ftp_user)
    {
        $this->gameserver = $gameserver;
        $this->database = $db;
        $this->db_user = $db_user;
        $this->ftp_user = $ftp_user;
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
