<?php

namespace App\Notifications\WeldingCertificate;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Verification extends Notification
{
    use Queueable;

    public $weldingCertificates;
    public $notification_before_verification;

    /**
     * Create a new notification instance.
     */
    public function __construct($weldingCertificates, $notification_before_verification)
    {
        $this->weldingCertificates = $weldingCertificates;
        $this->notification_before_verification = $notification_before_verification;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Welding Certificate needs Verification'))
            ->markdown('mail.welding-certificate.verfication', [
                'weldingCertificates' => $this->weldingCertificates,
                'notification_before_verification' => $this->notification_before_verification,
            ]);
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
