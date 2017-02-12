<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Database;
use App\Services\ServerManager;

class CleanDatabases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:cleanall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans the expired databases';

    private $server_manager;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ServerManager $server_manager)
    {
        parent::__construct();
        $this->server_manager = $server_manager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $gracePeriod = env('USER_DATA_GRACE_PERIOD', 7);
        $now = Carbon::now();
        foreach (Database::expired()->get() as $database) {
            $duration = $database->expired_on->diffInDays($now);
            if ($duration > $gracePeriod) {
                $database->delete();

                $server = $database->gameserver->server;
                // Actually remove stuff from remote server
                $this->server_manager->deleteDatabase($server, $database->name);
                foreach ($database->dbusers as $dbuser) {
                    $this->server_manager->deleteDatabaseUser($server, $dbuser->username);
                    $dbuser->delete();
                }
            }
        }   
    }
}
