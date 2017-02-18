<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\InstallGameServerPackage;

class InstallGameServerPackageTest extends TestCase
{
    use DatabaseTransactions;

    public function testHandle()
    {
        $gameserver = factory(App\GameServer::class)->create(['server_package_id' => factory(App\ServerPackage::class)->create()->id]);
        factory(App\FtpUser::class)->create(['game_server_id' => $gameserver->id]);
        $event = new \App\Events\GameServerVersionChangeEvent($gameserver, $gameserver->server_package);
        $listener = new InstallGameServerPackage(resolve(App\Services\GameServerManager::class));

        $this->assertTrue($listener->handle($event));
    }
}
