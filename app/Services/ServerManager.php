<?php 
namespace App\Services;

use App\Server;


class ServerManager 
{
    protected $ssh_manager;

    public function __construct(ServerSshManager $ssh_manager) 
    {
        $this->ssh_manager = $ssh_manager;
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

    public function deleteDatabase(Server $server, $db_name)
    {
        return $this->ssh_manager->execute($server, 'delete_database.php', [$db_name]);
    }

    public function deleteDatabaseUser(Server $server, $username)
    {   
        return $this->ssh_manager->execute($server, 'delete_database_user.php', [ $username ]);
    }

    public function deleteFtpUser(Server $server, $username)
    {   
        return $this->ssh_manager->execute($server, 'delete_ftp_user.php', [ $username ]);
    }

}