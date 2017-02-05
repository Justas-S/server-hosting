<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Database;

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
            }
        }   
    }
}
