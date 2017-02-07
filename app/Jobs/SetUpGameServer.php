<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\CreateGameServerDatabase;
use App\Services\CreateGameServerDatabaseUser;
use App\Services\CreateGameServerFtpUser;
use App\Gameserver;
use App\Events\GameServerSetUpEvent;

class SetUpGameServer implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var App\GameServer
     */
    protected $gameserver;

    protected $databaseGenerator;

    protected $databaseUserGenerator;

    protected $ftpUserGenerator;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GameServer $gameserver, CreateGameServerDatabase $dbgen, CreateGameServerDatabaseUser $dbusergen, CreateGameServerFtpUser $ftpusergen)
    {
        $this->gameserver = $gameserver;
        $this->databaseGenerator = $dbgen;
        $this->databaseUserGenerator = $dbusergen;
        $this->ftpUserGenerator = $ftpusergen;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $database = $this->databaseGenerator->create($this->gameserver);
        $dbuser = $this->databaseUserGenerator->create($database);
        $ftp_user = $this->ftpUserGenerator->create($this->gameserver);
        event(new GameServerSetUpEvent($this->gameserver, $database, $dbuser, $ftp_user));
    }
}
