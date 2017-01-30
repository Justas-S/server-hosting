<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GameServerAuthGeneratorProvider extends ServiceProvider
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
        $this->app->singleton(App\Services\GameServiceAuthGenerator::class, function ($app) {
            return new GameServiceAuthGenerator();
        });
    }
}
