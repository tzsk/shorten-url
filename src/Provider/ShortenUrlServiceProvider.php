<?php

namespace Tzsk\ShortenUrl\Provider;

use Illuminate\Support\ServiceProvider;
use Tzsk\ShortenUrl\GoogleUrlShortener;

class ShortenUrlServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('tzsk-shorten-url', function($app) {
            return new GoogleUrlShortener($app);
        });

        $this->publishes([
            __DIR__ . "/../Config/url.php" => config_path("url.php")
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}