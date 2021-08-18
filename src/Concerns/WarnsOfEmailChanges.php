<?php

namespace Anteris\LaravelSecurityNotifications\Concerns;

use Anteris\LaravelSecurityNotifications\Observers\EmailObserver;
use Illuminate\Database\Eloquent\Model;

trait WarnsOfEmailChanges
{
    protected static function bootWarnsOfEmailChanges()
    {
        // Create a new event "updatingEmail."
        static::updating(function (Model $model) {
            $emailAttribute = config(
                'laravel-security-notifications.models.' . $model::class . '.email',
                'email'
            );

            if (! $model->isDirty($emailAttribute)) {
                return null;
            }

            return $model->fireModelEvent('updatingEmail');
        });

        // Register the "updatingEmail" event with our observer.
        static::registerModelEvent('updatingEmail', EmailObserver::class . '@updatingEmail');
    }

    protected function initializeWarnsOfEmailChanges(): void
    {
        $this->addObservableEvents('updatingEmail');
    }

    public static function updatingEmail(string | callable $callback): void
    {
        static::registerModelEvent('updatingEmail', $callback);
    }
}
