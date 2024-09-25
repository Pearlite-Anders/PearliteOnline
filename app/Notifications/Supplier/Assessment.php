<?php

namespace App\Notifications\Supplier;

use App\Models\Supplier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Assessment extends Notification
{
    use Queueable;

    public array $supplierIds;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $supplierIds)
    {
        $this->supplierIds = $supplierIds;
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'supplierIds' => $this->supplierIds,
        ];
    }
}
