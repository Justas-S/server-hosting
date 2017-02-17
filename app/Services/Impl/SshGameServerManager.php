<?php
namespace App\Services\Impl;

use App\Services\ServerSshManager;
use App\Services\GameServerManager;
use App\GameServer;

class SshGameServerManager implements GameServerManager
{
    protected $ssh_manager;

    public function __construct(ServerSshManager $ssh_manager) 
    {
        $this->ssh_manager = $ssh_manager;
    }

    public function getServerConfig(GameServer $gameserver) 
    {
        return $this->ssh_manager->execute($gameserver->server, 'get_servercfg.php', [$gameserver->ftp_user->username], true);
    }

    public function setServerConfig(GameServer $gameserver, $config) 
    {
        $config = addslashes($config);
        return $this->ssh_manager->execute($gameserver->server, 'set_servercfg.php', [$gameserver->ftp_user->username, "'".$config."'" ]);
    }
}