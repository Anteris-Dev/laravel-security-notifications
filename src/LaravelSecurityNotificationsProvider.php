<?php

namespace Anteris\LaravelSecurityNotifications;

use Illuminate\Support\ServiceProvider;

class LaravelSecurityNotificationsProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'laravelSecurityNotifications');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravelSecurityNotifications'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../config/laravel-security-notifications.php' => config_path('laravel-security-notifications.php'),
        ], 'config');
    }
}
