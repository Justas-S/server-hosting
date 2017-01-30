<?php

namespace App\Listeners;

use App\Events\ServerInserted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
class ServerSetUp
{
    private $ssh;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  ServerInserted  $event
     * @return void
     */
    public function handle(ServerInserted $event)
    {
        

    }

}