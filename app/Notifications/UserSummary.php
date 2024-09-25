<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class UserSummary extends Notification
{
    use Queueable;

    protected ?DatabaseNotification $supplierAssessmentsNotification;

    /**
     * Create a new notification instance.
     */
    public function __construct(?DatabaseNotification $supplierAssessmentsNotification)
    {
        $this->supplierAssessmentsNotification = $supplierAssessmentsNotification;
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
        $supplierAssessmentsData = null;

        if ($this->supplierAssessmentsNotification) {
            $supplierAssessmentsData = $this->supplierAssessmentsNotification->data;
        }

        return (new MailMessage)
                ->subject(__('I need a good subjet!'))
                ->markdown('mail.user-summary', [
                    'supplier_assessments_data' => $supplierAssessmentsData,
                    'user' => $notifiable
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
