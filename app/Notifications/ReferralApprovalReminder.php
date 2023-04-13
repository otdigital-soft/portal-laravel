<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReferralApprovalReminder extends Notification
{
    use Queueable;

    private $user;
    private $referrer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $referrer)
    {
        $this->user = $user;
        $this->referrer = $referrer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Referral Approval Notification.')
            ->line("Hello {$this->referrer->name},")
            ->line("This is a notifier that you have a pending referral request from {$this->user->name}. Please take a moment to approve the request by logging into your account and visiting the referrals section.")
            ->action('Login', url('/login'))
            ->line('Thank you for using our platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
