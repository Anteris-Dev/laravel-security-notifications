<?php

namespace Anteris\Tests\LaravelSecurityNotifications\Concerns;

use Anteris\LaravelSecurityNotifications\Notifications\TwoFactorSecretChanged;
use Anteris\Tests\LaravelSecurityNotifications\Stubs\UserWithWarnOfTwoFactorChanges;
use Anteris\Tests\LaravelSecurityNotifications\Support\TestCase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;

class WarnsOfTwoFactorChangesTest extends TestCase
{
    public function test_updating_password_event_is_fired()
    {
        $notification = Notification::fake();

        $called = false;
        $model  = UserWithWarnOfTwoFactorChanges::create([
            'name'              => 'Test Name',
            'email'             => 'test.user@example.com',
            'password'          => 'Testing123',
            'two_factor_secret' => 'adfasdfasdf',
        ]);

        $model::updatingTwoFactorSecret(function () use (&$called) {
            $called = true;
        });

        $model->two_factor_secret = 'asdfas;dlfkjas;dlfkj';
        $model->save();

        $this->assertTrue($called);

        $notification->assertSentTo(
            (new AnonymousNotifiable())->route('mail', 'test.user@example.com'),
            TwoFactorSecretChanged::class
        );

        $notification->assertTimesSent(1, TwoFactorSecretChanged::class);
    }
}
