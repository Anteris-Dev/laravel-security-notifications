<?php

namespace Anteris\Tests\LaravelSecurityNotifications\Concerns;

use Anteris\LaravelSecurityNotifications\Notifications\EmailChangedNotification;
use Anteris\Tests\LaravelSecurityNotifications\Stubs\UserWithWarnOfEmailChanges;
use Anteris\Tests\LaravelSecurityNotifications\Support\TestCase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;

class WarnsOfEmailChangesTest extends TestCase
{
    public function test_updating_email_event_is_fired()
    {
        $notification = Notification::fake();

        $called = false;
        $model  = UserWithWarnOfEmailChanges::create([
            'name'     => 'Test Name',
            'email'    => 'test.user@example.com',
            'password' => 'Testing123',
        ]);

        $model::updatingEmail(function () use (&$called) {
            $called = true;
        });

        $model->email = 'other.user@example.com';
        $model->save();

        $this->assertTrue($called);

        $notification->assertSentTo(
            (new AnonymousNotifiable())->route('mail', 'test.user@example.com'),
            EmailChangedNotification::class
        );
    }
}
