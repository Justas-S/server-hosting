<?php 
namespace App\Services\Impl;

use App\Services\GameServerManager;
use App\GameServer;

class TestGameServerManager implements GameServerManager
{
    public function getServerConfig(GameServer $gameserver)
    {
        $server = $gameserver->server;
        $username = $gameserver->ftp_user->username;
        $faker = \Faker\Factory::create();
        return json_encode([
            'port'              => $faker->randomNumber(4),
            'hostname'          => 'SA-MP 0.3 Server',
            'gamemode0'         => $faker->word,
            'weburl'            => $faker->url,
            'rcon_password'     => $faker->password,
            'filterscripts'     => [$faker->word, $faker->word, $faker->word, $faker->word],
            'plugins'           => [$faker->word.'so', $faker->word.'.so', $faker->word.'.so'],
            'password'          => $faker->password,
            'mapname'           => 'San Andreas',
            'language'          => $faker->languageCode,
            'maxnpc'            => $faker->randomDigit,
        ]); 
    }

    public function setServerConfig(GameServer $gameserver, $config)
    {
        $server = $gameserver->server;
        $username = $gameserver->ftp_user->username;
        return $server && $username;
    }
}