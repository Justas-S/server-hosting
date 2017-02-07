<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CreateGameServerDatabase;
use App\Services\CreateGameServerDatabaseUser;
use App\Services\CreateGameServerFtpUser;

class GameServerServicePrvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(App\CreateGameServerDatabase::class, function ($app) {
            return new CreateGameServerDatabase();
        }); 

        $this->app->singleton(App\CreateGameServerDatabaseUser::class, function ($app) {
            return new CreateGameServerDatabaseUser();
        }); 

        $this->app->singleton(App\CreateGameServerFtpUser::class, function ($app) {
            return new CreateGameServerFtpUser();
        }); 
    }
}
