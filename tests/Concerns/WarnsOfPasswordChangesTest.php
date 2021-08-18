<?php

namespace Concerns;

use Anteris\LaravelSecurityNotifications\Notifications\PasswordChangedNotification;
use Anteris\Tests\LaravelSecurityNotifications\Stubs\UserWithWarnOfPasswordChanges;
use Anteris\Tests\LaravelSecurityNotifications\Support\TestCase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;

class WarnsOfPasswordChangesTest extends TestCase
{
    public function test_updating_password_event_is_fired()
    {
        $notification = Notification::fake();

        $called = false;
        $model  = UserWithWarnOfPasswordChanges::create([
            'name'     => 'Test Name',
            'email'    => 'test.user@example.com',
            'password' => 'Testing123',
        ]);

        $model::updatingPassword(function () use (&$called) {
            $called = true;
        });

        $model->password = 'Somethingelse';
        $model->save();

        $this->assertTrue($called);

        $notification->assertSentTo(
            (new AnonymousNotifiable())->route('mail', $model->email),
            PasswordChangedNotification::class
        );

        $notification->assertTimesSent(1, PasswordChangedNotification::class);
    }
}
