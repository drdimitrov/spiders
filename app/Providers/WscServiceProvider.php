<?php

namespace App\Providers;

use App\Services\WscService;
use Illuminate\Support\ServiceProvider;

class WscServiceProvider extends ServiceProvider
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
        $this->app->singleton(WscService::class, function($app){
            return new WscService(env('WSC_API_KEY'));
        });
    }
}
