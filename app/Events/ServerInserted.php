<?php

namespace App\Events;

use App\Server;

class ServerInserted
{
    public $server;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

}
