<?php 
namespace App\Services\Impl;

use App\Services\GameServerManager;
use App\GameServer;
use App\ServerPackage;
use App\Plugin;

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
            'plugins'           => [$this->getRandomPlugin($gameserver)->name.'.so', $this->getRandomPlugin($gameserver)->name.'.so', $this->getRandomPlugin($gameserver)->name.'.so'],
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

    public function installServerPackage(GameServer $gamesrever, $username, ServerPackage $server_package)
    {
        return true;
    }

    public function installPlugin(GameServer $gameserver, $username, Plugin $plugin)
    {
        return true;
    }

    public function clearPlugins(GameServer $gameserver, $username)
    {
        return true;
    }

    private function getRandomPlugin($gameserver) 
    {
        return \App\Plugin::where('game_id', $gameserver->game->id)->inRandomOrder()->first();
    }
}