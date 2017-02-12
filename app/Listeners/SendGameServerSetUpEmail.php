<?php 
namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\GameServerSetUpEvent;
use App\Mail\GameServerSetUp;

/**
 * Queues the mailing job
 */
class SendGameServerSetUpEmail implements ShouldQueue
{
    public function __construct()
    {

    }

    public function handle(GameServerSetUpEvent $event)
    {
        Mail::to($event->gameserver->user->email)
            ->queue(new GameServerSetUp($event->gameserver, $event->database, $event->db_user, $event->ftp_user));
    }
}