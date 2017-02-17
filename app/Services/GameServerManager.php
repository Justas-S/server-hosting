<?php
namespace App\Services;

use App\Services\ServerSshManager;
use App\GameServer;

interface GameServerManager 
{
    /**
     * Returns the server config data from a specified gameserver
     * 
     * @param App\GameServer gameserver
     *
     * @return server configuration as json
     */
    public function getServerConfig(GameServer $gameserver);

    /** 
     * Sets the server configuration
     *
     * @param App\GameServer gameserver
     * @param config in json format
     *
     * @return bool true if success, false otherwise
     */
    public function setServerConfig(GameServer $gameserver, $config);
}