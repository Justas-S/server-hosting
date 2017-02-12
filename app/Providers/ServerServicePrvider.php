<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ServerSshManager;
use App\Services\ServerManager;

class ServerServicePrvider extends ServiceProvider
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
        $this->app->singleton(ServerSshManager::class, function ($app) {
            return new ServerSshManager();
        }); 

        $this->app->singleton(ServerManager::class, function ($app) {
            return new ServerManager();
        });
    }
}
