<?php

namespace Anteris\LaravelSecurityNotifications\Observers;

use Anteris\LaravelSecurityNotifications\Notifications\PasswordChangedNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class PasswordObserver
{
    public function updatingPassword(Model $model): void
    {
        $passwordAttribute = config(
            'laravel-security-notifications.models.' . $model::class . '.password',
            'password'
        );

        $emailAttribute = config(
            'laravel-security-notifications.models.' . $model::class . '.email',
            'email'
        );

        Notification::route('mail', $model->getOriginal($emailAttribute))->notify(
            new PasswordChangedNotification()
        );
    }
}
