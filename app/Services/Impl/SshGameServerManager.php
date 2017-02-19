<?php
namespace App\Services\Impl;

use App\Services\ServerSshManager;
use App\Services\GameServerManager;
use App\GameServer;
use App\ServerPackage;
use App\Plugin;

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

    public function installServerPackage(GameServer $gamesrever, $username, ServerPackage $server_package)
    {
        return $this->ssh_manager->execute($gameserver->server, 'install_server_package.php', [$username, $server_package->url]);
    }

    public function installPlugin(GameServer $gameserver, $username, Plugin $plugin)
    {
        return $this->ssh->manager->execute($gameserver->server, 'install_plugin.php', [$username, $plugin->url]);
    }

    public function clearPlugins(GameServer $gameserver, $username)
    {
        return $this->ssh->manager->execute($gameserver->server, 'clear_plugins.php', [$username]);
    }

}