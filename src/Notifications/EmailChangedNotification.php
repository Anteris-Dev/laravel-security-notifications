<?php

namespace Anteris\LaravelSecurityNotifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private string $oldEmail, private string $newEmail)
    {
        //
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())->view(
            'laravelSecurityNotifications::email_changed_notification',
            [
                'oldEmail' => $this->oldEmail,
                'newEmail' => $this->newEmail,
            ]
        );
    }
}
