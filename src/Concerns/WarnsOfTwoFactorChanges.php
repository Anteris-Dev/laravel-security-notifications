<?php

namespace Anteris\LaravelSecurityNotifications\Concerns;

use Anteris\LaravelSecurityNotifications\Observers\TwoFactorObserver;
use Illuminate\Database\Eloquent\Model;

trait WarnsOfTwoFactorChanges
{
    public static function bootWarnsOfTwoFactorChanges()
    {
        // Fire events when the two factor secret is getting updated.
        static::updating(function (Model $model) {
            $twoFactorAttribute = config(
                'laravel-security-notifications.models.' . $model::class . '.two_factor_secret',
                'two_factor_secret'
            );

            if ($model->isDirty($twoFactorAttribute)) {
                $model->fireModelEvent('updatingTwoFactorSecret');
            }
        });

        // Observe two factor updates.
        static::observe(TwoFactorObserver::class);
    }

    protected function initializeWarnsOfTwoFactorChanges()
    {
        $this->addObservableEvents('updatingTwoFactorSecret');
        $this->registerObserver(TwoFactorObserver::class);
    }

    public static function updatingTwoFactorSecret(string|callable $callback)
    {
        static::registerModelEvent('updatingTwoFactorSecret', $callback);
    }
}
