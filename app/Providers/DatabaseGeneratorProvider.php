<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DatabaseGeneratorProvider extends ServiceProvider
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
        $this->app->singleton(App\Services\DatabaseGenerator::class, function ($app) {
            return new DatabaseGenerator();
        });
    }
}
