<?php
namespace App\Services;

use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use App\GameServer;

class CreateGameServerDatabase
{
    /**
     * @var App\Services\DatabaseGenerator
     */
    protected $generator;

    /**
     * Creates a new instance
     */
    public function __construct()
    {
        $this->generator = resolve(\App\Services\DatabaseGenerator::class);
    }

    /**
     * Creates a new database
     *
     * @param gameserver owner of the database
     *
     * @return App\Database or false on failure
     */
    public function create(GameServer $gameserver)
    {
        $server = $this->gameserver->server;
        $ssh = new SSH2($server->ip);
        $key = new RSA();

        try {
            $key->loadKey(file_get_contents(storage_path('keys/'.$server->id)));
            $database = $this->generator->create($this->gameserver, $this->gameserver->user);
            if($ssh->login('root', $key))
            {
                $ssh->enablePTY();
                $ssh->exec("mysql -u root");
                $ssh->exec("CREATE DATABASE ".$database->name.";");
                $ssh->disconnect();
                return $database;
            }
        } catch(\ErrorException $e) {

        }
        return false;
    }
}