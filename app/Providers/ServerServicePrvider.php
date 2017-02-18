<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ServerSshManager;
use App\Services\ServerManager;
use App\Services\GameServerManager;

class ServerServicePrvider extends ServiceProvider
{
    protected $defer = true;
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
            return new ServerManager($this->app->make(ServerSshManager::class));
        });

        $this->app->singleton(GameServerManager::class, function ($app) {
            if (!$app->runningUnitTests() && !$app->isLocal()) 
                return new \App\Services\Impl\SshGameServerManager($this->app->make(ServerSshManager::class));
            else 
                return new \App\Services\Impl\TestGameServerManager();
        }); 
    }
}
