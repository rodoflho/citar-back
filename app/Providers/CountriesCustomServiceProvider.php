<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\Countries;

class CountriesCustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\Countries', function ($app) {
            return new Countries();
        });
    }
}