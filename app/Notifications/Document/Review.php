<?php

namespace App\Notifications\Document;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class Review extends Notification
{
    use Queueable;

    public array $documentIds;

    /**
     * Create a new notification instance.
     *
     * @param array<int> $documentIds ids for the documents to be reviewed
     */
    public function __construct(array $documentIds)
    {
        $this->documentIds = $documentIds;
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
            'documentIds' => $this->documentIds,
        ];
    }
}
