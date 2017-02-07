<?php 
namespace App\Services;

use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use App\Database;
use App\DatabaseUser;

class CreateGameServerDatabaseUser 
{
    public function __construct()
    {

    }

    /**
     * Creates a database user for the specified database
     *
     * @param App\Database
     * 
     * @return App\DatabaseUser with the password set or false
     */
    public function create(Database $database)
    {
        $server = $database->gameserver->server;
        $ssh = new SSH2($server->ip);
        $key = new RSA();
        $key->loadKey(file_get_contents(storage_path('keys/'.$server->id)));
        if($ssh->login('root', $key))
        {
            $dbuser = $database->dbusers()->DatabaseUser::create([
                'user_id'       => $database->gameserver->user->id,
                'username'      => $database->name,
            ]);
            $dbpass = str_random(32);
            $dbuser->password = $dbpass;

            $ssh->enablePTY();
            $ssh->exec("CREATE USER '".$dbuser->username."'@'%' IDENTIFIED BY '".$dbpass."';");
            $ssh->exec("GRANT ALL PRIVILEGES ON ".$database->name.".* TO '".$dbuser->username."'@'%';");
            $ssh->disconnect();
            return $dbuser;
        }
        return false;
    }
}