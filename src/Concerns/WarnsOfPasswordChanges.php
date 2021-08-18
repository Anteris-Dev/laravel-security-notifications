<?php

namespace Anteris\LaravelSecurityNotifications\Concerns;

use Anteris\LaravelSecurityNotifications\Observers\PasswordObserver;
use Illuminate\Database\Eloquent\Model;

trait WarnsOfPasswordChanges
{
    protected static function bootWarnsOfPasswordChanges()
    {
        // Create a new event "updatingPassword."
        static::updating(function (Model $model) {
            $passwordAttribute = config(
                'laravel-security-notifications.models.' . $model::class . '.password',
                'password'
            );

            if (! $model->isDirty($passwordAttribute)) {
                return null;
            }

            return $model->fireModelEvent('updatingPassword');
        });

        // Register the "updatingPassword" event with our observer.
        static::registerModelEvent('updatingPassword', PasswordObserver::class . '@updatingPassword');
    }

    protected function initializeWarnsOfPasswordChanges()
    {
        $this->addObservableEvents('updatingPassword');
    }

    public static function updatingPassword(string | callable $callback)
    {
        static::registerModelEvent('updatingPassword', $callback);
    }
}
