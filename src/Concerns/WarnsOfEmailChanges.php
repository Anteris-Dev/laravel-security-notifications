<?php

namespace Anteris\LaravelSecurityNotifications\Concerns;

use Anteris\LaravelSecurityNotifications\Observers\EmailObserver;
use Illuminate\Database\Eloquent\Model;

trait WarnsOfEmailChanges
{
    protected static function bootWarnsOfEmailChanges()
    {
        // Fire events when the email is getting updated.
        static::updating(function (Model $model) {
            $emailAttribute = config(
                'laravel-security-notifications.models.' . $model::class . '.email',
                'email'
            );

            if ($model->isDirty($emailAttribute)) {
                $model->fireModelEvent('updatingEmail');
            }
        });
    }

    protected function initializeWarnsOfEmailChanges(): void
    {
        $this->addObservableEvents('updatingEmail');
        $this->registerObserver(EmailObserver::class);
    }

    public static function updatingEmail(string | callable $callback): void
    {
        static::registerModelEvent('updatingEmail', $callback);
    }
}
