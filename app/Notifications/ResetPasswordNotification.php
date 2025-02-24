<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Mail\Attachment;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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

    /**
     * Get the mail representation of the notification.
     */
   public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Reset Password Notification')
        ->greeting('Hello!')
        ->line('You are receiving this email because we received a password reset request for your account.')
        ->action('Reset Password', url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->email], false)))
        ->line('If you did not request a password reset, no further action is required.');
}

    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('asset-view/assets/png/logo_bangbara.png'))
                ->as('logo_bangbara.png')
                ->withMime('image/png'),
        ];
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
