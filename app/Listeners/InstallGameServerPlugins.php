<?php

namespace App\Listeners;

use App\Events\GameServerPluginInstallEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\GameServerManager;

class InstallGameServerPlugins
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
     * @param  GameServerPluginInstallEvent  $event
     * @return void
     */
    public function handle(GameServerPluginInstallEvent $event)
    {
        $this->manager->clearPlugins($event->gameserver, $gameserver->ftp_user->username);
        $this->event->plugins->forEach(function $plugin) {
            $this->manager->installPlugin($event->gameserver, $gameserver->ftp_user->username, $plugin);
        }
    }
}
