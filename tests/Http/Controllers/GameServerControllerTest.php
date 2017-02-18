<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GameServerControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testPostVersion()
    {
        $user = factory(App\User::class)->create();
        $gameserver = factory(\App\GameServer::class)->create(['user_id' => $user->id]);
        $server_package = factory(\App\ServerPackage::class)->create(['game_id' => $gameserver->game->id]);

        $this->expectsEvents(\App\Events\GameServerVersionChangeEvent::class);
        $response = $this->actingAs($user)
            ->route('POST', 'gameserver.management.version', $gameserver->id, [
                'server_package_id' => $server_package->id
            ]);

        $gameserver = App\GameServer::find($gameserver->id);
        $this->assertEquals($response->getStatusCode(), 302);
        $this->assertTrue($gameserver->server_package->id == $server_package->id);
    }
}
