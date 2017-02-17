<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetConfig()
    {
        $gameserver = factory(App\GameServer::class)->create(['user_id' => factory(App\User::class)->create()->id]);
        $ftp_user = factory(App\FtpUser::class)->create(['game_server_id' => $gameserver->id]);
        $gameserver->ftp_users->push($ftp_user);


        $this->actingAs($gameserver->user)
            ->json('GET', '/ajax/gameservers/'.$gameserver->id.'/server.cfg')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'hostname',
                'plugins',
                'filterscripts',
                'maxnpc',
            ]);
    }
}   
