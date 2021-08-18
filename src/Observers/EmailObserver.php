<?php

namespace Anteris\LaravelSecurityNotifications\Observers;

use Anteris\LaravelSecurityNotifications\Notifications\EmailChangedNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class EmailObserver
{
    public function updatingEmail(Model $model): void
    {
        $emailAttribute = config(
            'laravel-security-notifications.models.' . $model::class . '.email',
            'email'
        );

        Notification::route('mail', $model->getOriginal($emailAttribute))->notify(
            new EmailChangedNotification(
                oldEmail: $model->getOriginal($emailAttribute),
                newEmail: $model->getAttribute($emailAttribute)
            )
        );
    }
}
