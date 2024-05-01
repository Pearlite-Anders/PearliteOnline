<?php

namespace App\Notifications\WeldingCertificate;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CombinedNotifications extends Notification
{
    use Queueable;

    public $notifications;

    /**
     * Create a new notification instance.
     */
    public function __construct($notifications)
    {
        $this->notifications = $notifications;
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
        $expirations = $this->notifications->firstWhere('type', 'App\Notifications\WeldingCertificate\Expiration');
        if($expirations) {
            $data = $expirations->data;
            $expirations->weldingCertificates = collect($data['weldingCertificates']);
            $expirations->notification_before_expiration = $data['notification_before_expiration'];
        }

        $verifications = $this->notifications->firstWhere('type', 'App\Notifications\WeldingCertificate\Verification');
        if($verifications) {
            $data = $verifications->data;
            $verifications->weldingCertificates = collect($data['weldingCertificates']);
            $verifications->notification_before_verification = $data['notification_before_verification'];
        }

        return (new MailMessage)
                ->subject(__('Welding Certificates updates'))
                ->markdown('mail.welding-certificate.combined-notifications', [
                    'expirations' => $expirations,
                    'verifications' => $verifications,
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
