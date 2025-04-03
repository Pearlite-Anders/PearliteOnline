<?php

namespace App\Notifications\MachineMaintenance;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Maintenance extends Notification
{
    use Queueable;

    public array $machineMaintenanceIds;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $machineMaintenanceIds)
    {
        $this->machineMaintenanceIds = $machineMaintenanceIds;
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
            'machineMaintenanceIds' => $this->machineMaintenanceIds,
        ];
    }
}
