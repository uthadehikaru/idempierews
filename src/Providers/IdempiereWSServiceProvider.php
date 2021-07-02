<?php

namespace Uthadehikaru\IdempiereWS\Providers;

use Illuminate\Support\ServiceProvider;

class IdempiereWSServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/idempierews.php' => config_path('idempierews.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}