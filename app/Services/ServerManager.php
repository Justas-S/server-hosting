<?php 
namespace App\Services;

use App\Server;

class ServerManager 
{
    protected $ssh_manager;

    public function __construct() 
    {
        $this->ssh_manager = make(App\Services\ServerSshManager::class);
    }

    public function createDatabase(Server $server, $db_name)
    {
        return $this->ssh_manager->execute($server, 'create_database.php', [$db_name]);
    }

    public function createDatabaseUser(Server $server, $username, $password, $db_name)
    {
        return $this->ssh_manager->execute($server, 'create_database_user.php', [$username, $password, $db_name]);
    }

    public function createFtpUser(Server $server, $username, $password) 
    {
        return $this->ssh_manager->execute($server, 'create_ftp_user.php', [$username, $password]);
    }
}