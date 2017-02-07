<?php 
namespace App\CreateGameServerFtpUser;

use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use App\GameServer;
use App\FtpUser;

class CreateGameServerFtpUser
{
    /**
     * Creates a new FTP user for the specified game server
     *
     * @param App\GameServer 
     * 
     * @return App\FtpUser or false if something fails
     */
    public function create(GameServer $gameserver)
    {
        $server = $gameserver->server;
        $ssh = new SSH2($server->ip);
        $key = new RSA();
        $key->loadKey(file_get_contents(storage_path('keys/'.$server->id)));
        if($ssh->login('root', $key))
        {
            $ftpUser = FtpUser::create([
                'user_id'       => $gameserver->user->id,
                'game_server_id'=> $gameserver->id
                'username'      => $str_random(10),
            ]);
            $ftpPassword = str_random(32);
            $ftpUser->password = $ftpPassword;

            $ssh->exec("useradd -m -b /home -g sftponly -p '".hash("MD5", $ftpPassword)."' ".$ftpUser->username);
            $ssh->exec("setquota -u ".$ftpUser->username." 100 200 0 0 -a /");
            $ssh->disconnect();
            return $ftpUser;
        }
        return false;
    }   
}