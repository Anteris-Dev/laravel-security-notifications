<?php

namespace Anteris\LaravelSecurityNotifications\Concerns;

use Anteris\LaravelSecurityNotifications\Observers\TwoFactorObserver;
use Illuminate\Database\Eloquent\Model;

trait WarnsOfTwoFactorChanges
{
    public static function bootWarnsOfTwoFactorChanges()
    {
        // Create a new event "updatingTwoFactorSecret."
        static::updating(function (Model $model) {
            $twoFactorAttribute = config(
                'laravel-security-notifications.models.' . $model::class . '.two_factor_secret',
                'two_factor_secret'
            );

            if (! $model->isDirty($twoFactorAttribute)) {
                return null;
            }

            return $model->fireModelEvent('updatingTwoFactorSecret');
        });

        // Register the "updatingTwoFactorSecret" event with our observer.
        static::registerModelEvent('updatingTwoFactorSecret', TwoFactorObserver::class . '@updatingTwoFactorSecret');
    }

    protected function initializeWarnsOfTwoFactorChanges()
    {
        $this->addObservableEvents('updatingTwoFactorSecret');
    }

    public static function updatingTwoFactorSecret(string | callable $callback)
    {
        static::registerModelEvent('updatingTwoFactorSecret', $callback);
    }
}
