<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmail extends Notification
{
    use Queueable;

    public function __construct(MailMessage $mailMessage)
    {
        $this->mailMessage = $mailMessage;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return $this->mailMessage;
    }
}
