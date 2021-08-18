<?php

namespace Anteris\LaravelSecurityNotifications\Observers;

use Anteris\LaravelSecurityNotifications\Notifications\TwoFactorSecretChanged;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class TwoFactorObserver
{
    public function updatingTwoFactorSecret(Model $model)
    {
        $emailAttribute = config(
            'laravel-security-notifications.models.' . $model::class . '.email',
            'email'
        );

        Notification::route('mail', $model->getOriginal($emailAttribute))->notify(
            new TwoFactorSecretChanged()
        );
    }
}
