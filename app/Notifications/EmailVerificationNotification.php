<?php

namespace App\Notifications;

use Ichtrojan\Otp\Models\Otp as ModelsOtp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    public $message;
    public $fromEmail;
    public $mailer; //if  i user many emails
    public $subject;
    private $otp;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //

        $this->message = "use the below code for verification process";
        $this->subject = "Verification Needed ";
        $this->fromEmail = "hello@example.com";
        $this->mailer = "smtp";
        $this->otp = new Otp;
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
    public function toMail($notifiable): MailMessage
    {
        $otp = $this->otp->generateOtp($notifiable->email, 6, 60);
        return (new MailMessage)
            ->mailer('smtp')
            ->subject($this->subject)
            ->greeting('Hello' . $notifiable->name)
            ->line($this->message)
            ->line('code: ' . $otp->token);
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
