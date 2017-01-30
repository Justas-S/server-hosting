<?php 
namespace App\Services;

use App\GameServer;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Generates required authentication details for GameServers. 
 * Currently those details are phpMyAdmin and FTP logins and password
 */
class GameServerAuthGenerator
{
    public function getPMAUsername(GameServer $server)
    {
        if($server->user)
            return Hashids::encode([$server->id, $server->game->id, $server->user->id]);
        else 
            return null;
    }

    public function getFTPUsername(GameServer $server)
    {
        if($server->user)
            return Hashids::encode([$server->id, $server->game->id, $server->user->id, $server->server->id]);
        else 
            return null;
    }

    public function getPMAPassword(GameServer $server)
    {
        return str_random(20);
    }

    public function getFTPPassword(GameServer $server)
    {
        return str_random(20);
    }
}