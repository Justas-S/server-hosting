<?php
namespace App\Services;

use App\Services\ServerSshManager;
use App\GameServer;
use App\ServerPackage;

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

    /**
     * Install a server package
     * 
     * @param App\Gameserver gameserver
     * @param username
     * @param APp\ServerPackage server_package
     *
     * @return bool true if succes, false otherwise
     */
    public function installServerPackage(GameServer $gamesrever, $username, ServerPackage $server_package);
}