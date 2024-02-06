<?php

namespace ToneflixCode\KudiSmsNotification;

use Illuminate\Support\ServiceProvider;

class KudiSmsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('kudi-notification.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'kudi-notification');

        // Register the main class to use with the facade
        $this->app->singleton('kudi-notification', function () {
            return new KudiSmsNotification();
        });
    }
}
