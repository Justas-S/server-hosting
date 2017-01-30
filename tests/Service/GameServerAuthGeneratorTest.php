<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\GameServer;

class GameServerAuthGeneratorTest extends TestCase
{
    private $generator;

    public function __construct()
    {
        $this->generator = resolve(App\Services\GameServerAuthGenerator::class);
    }

    public function testGetPMAUsername()
    {
        $server = factory(GameServer::class)->create();
        $server->user = factory(App\User::class)->create();
        $username = $this->generator->getPMAUsername($server);

        $this->assertNotNull($username);
    }

    public function testGetFTPUsername()
    {
        $server = factory(GameServer::class)->create();
        $server->user = factory(App\User::class)->create();
        $username = $this->generator->getFTPUsername($server);

        $this->assertNotNull($username);
    }

    public function testGetFTPPassword()
    {
        $server = factory(GameServer::class)->create();
        $server->user = factory(App\User::class)->create();
        $password = $this->generator->getFTPPassword($server);

        $this->assertNotNull($password);
    }

    public function testGetPMAPassword()
    {
        $server = factory(GameServer::class)->create();
        $server->user = factory(App\User::class)->create();
        $password = $this->generator->getPMAPassword($server);

        $this->assertNotNull($password);
    }
}
