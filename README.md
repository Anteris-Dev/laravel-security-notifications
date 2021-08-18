# [WIP] Laravel Security Notifications

[![Tests](https://github.com/Anteris-Dev/laravel-security-notifications/actions/workflows/tests.yaml/badge.svg)](https://github.com/Anteris-Dev/laravel-security-notifications/actions/workflows/tests.yaml)
[![Style](https://github.com/Anteris-Dev/laravel-security-notifications/actions/workflows/style.yaml/badge.svg)](https://github.com/Anteris-Dev/laravel-security-notifications/actions/workflows/style.yaml)

This package adds security notifications to warn your users when significant security events occur so that they aren't the next victim of an attacker.

## WarnsOfEmailChanges
The `Anteris\LaravelSecurityNotifications\Concerns\WarnsOfEmailChanges` trait adds an `updatingEmail` event to your model and automatically sends a notification to the user when their email is changed. Note that the notification is sent to their previous email, not the updated one.

## WarnsOfPasswordChanges
The `Anteris\LaravelSecurityNotifications\Concerns\WarnsOfPasswordChanges` trait adds an `updatingPassword` event to your model and automatically sends a notification to the user when their password is changed. Note that if their email is changed at the same time, the notification is sent to their previous email, not the updated one, in case an attacker is attempting to change their email as well.

## WarnsOfTwoFactorChanges
The `Anteris\LaravelSecurityNotifications\Concerns\WarnsOfTwoFactorChanges` trait adds an `updatingTwoFactorSecret` event to your model and automatically sends a notification to the user when their two factor secret is changed. Note that if their email is changed at the same time, the notification is sent to their previous email, not the updated one, in case an attacker is attempting to change their email as well.

## Configuring Attributes
To configure the attributes used on the model to determine changes, publish the configuration file with the command:

```shell
php artisan vendor:publish --provider="Anteris\LaravelSecurityNotifications\LaravelSecurityNotificationsServiceProvider" --tag=config
```

Now open the file `config/laravel-security-notifications.php` and create a record for your model under the `models` array. For example:

```php
return [
    'models' => [
        App\Models\User::class => [
            'email' => 'some_other_email_attribute',
            'password' => 'some_other_password_attribute',
            'two_factor_secret' => 'some_other_two_factor_attribute',
        ]  
    ]
];
```

## Configuring Emails
To modify the emails sent to your users, publish the blade files by running:

```shell
php artisan vendor:publish --provider="Anteris\LaravelSecurityNotifications\LaravelSecurityNotificationsServiceProvider" --tag=views
```

This will place the blade files in `resources/views/vendor/laravelSecurityNotifications`.