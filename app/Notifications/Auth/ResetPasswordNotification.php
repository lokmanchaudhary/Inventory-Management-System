<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $url;
    public string $token;
    public function __construct($url,$token){
        $this->url = $url;
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(config('app.client_name').' - Reset Password')
            ->greeting('Dear Customer')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $this->url)
            ->line('This password reset link will expire in 60 minutes.')
            ->line('If you did not request a password reset, no further action is required.')
            ->line('Thanks You!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
