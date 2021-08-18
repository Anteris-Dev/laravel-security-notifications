<?php

namespace Anteris\LaravelSecurityNotifications\Concerns;

use Anteris\LaravelSecurityNotifications\Observers\PasswordObserver;
use Illuminate\Database\Eloquent\Model;

trait WarnsOfPasswordChanges
{
    protected static function bootWarnsOfPasswordChanges()
    {
        // Fire events when the password is getting updated.
        static::updating(function (Model $model) {
            $passwordAttribute = config(
                'laravel-security-notifications.models.' . $model::class . '.password',
                'password'
            );

            if ($model->isDirty($passwordAttribute)) {
                $model->fireModelEvent('updatingPassword');
            }
        });
    }

    protected function initializeWarnsOfPasswordChanges()
    {
        $this->addObservableEvents('updatingPassword');
        $this->registerObserver(PasswordObserver::class);
    }

    public static function updatingPassword(string|callable $callback)
    {
        static::registerModelEvent('updatingPassword', $callback);
    }
}
