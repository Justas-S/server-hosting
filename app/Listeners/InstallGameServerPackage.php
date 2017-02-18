<?php

namespace App\Listeners;

use App\Events\GameServerVersionChangeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\GameServerManager;

class InstallGameServerPackage
{
    private $manager;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(GameServerManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Handle the event.
     *
     * @param  GameServerVersionChangeEvent  $event
     * @return void
     */
    public function handle(GameServerVersionChangeEvent $event)
    {
        $this->manager->installServerPackage($event->gameserver, $event->gameserver->ftp_user->username, $event->$package);
    }
}
