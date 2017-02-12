<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\DatabaseGenerator;
use App\Services\ServerManager;
use App\GameServer;
use App\Events\GameServerSetUpEvent;

class SetUpGameServer implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var App\GameServer
     */
    protected $gameserver;

    protected $servermanager;

    protected $dbgenerator;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GameServer $gameserver, ServerManager $server_manager, DatabaseGenerator $generator)
    {
        $this->gameserver = $gameserver;
        $this->servermanager = $server_manager;
        $this->dbgenerator = $generator;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $database = $dbgenerator->create($this->gameserver, $this->gameserver->user);
        $dbuser = $this->gameserver->database()->create([
            'user_id'       => $database->gameserver->user->id,
            'username'      => $database->name
        ]);
        $dbuser->password = str_random(32);

        $ftpuser = FtpUser::create([
            'user_id'       => $gameserver->user->id,
            'game_server_id'=> $gameserver->id
            'username'      => $str_random(10),
        ]);
        $ftpuser->password = str_random(16);

        $server = $this->gameserver->server;

        if ($this->servermanager->createDatabase($server, $database->name)
            && $this->servermanager->createDatabaseUser($server, $dbuser->username, $dbuser->password, $dbuser->database->name) 
            && $this->servermanager->createFtpUser($server, $ftpuser->username, $ftpuser->password)) {
            event(new GameServerSetUpEvent($this->gameserver, $database, $dbuser, $ftp_user));
        } else {
            // TODO ERROR
        }
    }


}
