<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\GameServer;
use App\Database;
use App\User;

class DatabaseGeneratorTest extends TestCase
{
    use DatabaseTransactions;

    private $generator;

    public function __construct()
    {
        $this->generator = resolve(App\Services\DatabaseGenerator::class);
    }

    public function testCreate()
    {
        $gameserver = factory(GameServer::class)->create();
        $user = factory(User::class)->create();

        $database = $this->generator->create($gameserver, $user);
        $this->assertNotNull($database);
        $this->seeInDatabase('databases', ['id' => $database->id]);

        // Ensure name is unique
        $databases = Database::where('name', $database->name)->get();
        $this->assertTrue(sizeof($databases) == 1);
    }
}
