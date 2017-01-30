<?php
namespace App\Services;

use App\GameServer;
use App\User;
use App\Database;
use Hashids;

class DatabaseGenerator 
{

    /**
     * Generates a database instance based on the GameServer and User provided
     *
     * @param server the game server to generate a database for
     * @param user owner of the database
     *
     * @return a Database object instance
     */
    public function create(GameServer $server, User $user)
    {
        $name = Hashids::encode($server->id, $user->id, rand(0, 999999));
        $database =  Database::create([
            'user_id'           => $user->id,
            'game_server_id'    => $server->id,
            'name'              => $name,
        ]);
        return $database;
    }
}