<?php

namespace App\Notifications\WeldingCertificate;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Expiration extends Notification
{
    use Queueable;

    public $weldingCertificates;
    public $notification_before_expiration;

    /**
     * Create a new notification instance.
     */
    public function __construct($weldingCertificates, $notification_before_expiration)
    {
        $this->weldingCertificates = $weldingCertificates;
        $this->notification_before_expiration = $notification_before_expiration;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject(__('Welding Certificate to Expire'))
                    ->markdown('mail.welding-certificate.expiration', [
                        'weldingCertificates' => $this->weldingCertificates,
                        'notification_before_expiration' => $this->notification_before_expiration,
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
            'weldingCertificates' => $this->weldingCertificates,
            'notification_before_expiration' => $this->notification_before_expiration,
        ];
    }
}
