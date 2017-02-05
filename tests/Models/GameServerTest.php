<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GameServerTest extends TestCase
{
    
    use DatabaseTransactions;

    public function testGetDatabaseAttribute()
    {
        $gameserver = factory(App\GameServer::class)->create();
        for ($i = 0; $i < 3; $i++) {
            $db = factory(App\Database::class)->create(['game_server_id' => $gameserver->id]);
        }
        $db = $gameserver->databases->random();
        $db->expired_on = \Carbon\Carbon::now();
        $db->save();

        $this->assertNotNull($gameserver->database);
        $this->assertNotNull($gameserver->database->expired_on);
    }
}
