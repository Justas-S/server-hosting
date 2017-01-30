<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\ServerSetUp;
use App\Events\ServerInserted;

class ServerSetUpListenerTest extends TestCase
{
    use DatabaseTransactions;


    public function testServerListener()
    {
        if(($server = App\Server::first()))
        {
            $listener = new ServerSetUp();
            $listener->handle(new ServerInserted($server));
        }
    }

}   
