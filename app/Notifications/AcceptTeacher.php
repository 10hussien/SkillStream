<?php

namespace App\Notifications;

use App\utils\translate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptTeacher extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line(sprintf('%s %s', (new translate)->translate('Dear teacher'), $this->username))
            ->line((new translate)->translate('We would like to inform you that you have been accepted into the application due to your high efficiency.'))
            ->line((new translate)->translate('We hope that the application will be helpful to you to provide your explanation and information.'))
            ->line((new translate)->translate('If you have any questions, please contact the app owner or add a comment to the app in order to improve it.'))
            ->line((new translate)->translate('Thanks .'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
