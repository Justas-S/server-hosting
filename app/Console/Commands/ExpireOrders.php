<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Order;

class ExpireOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for expired orders';

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
        $now = Carbon::now();
        foreach (Order::active()->get() as $order) {
            if ($order->created_at->diffInDays($now) >= $order->duration) {
                $order->expired_on = $now;

                // clean ftp users
                foreach ($order->gameserver->ftp_users as $ftp_user) {
                    $ftp_user->delete();
                }

                // Set DB expired
                $db = $order->gameserver->database;
                $db->expired_on = $now;
                $db->save();
                
            }
        }
    }
}
