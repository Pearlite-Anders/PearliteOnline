<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\Setting;
use Illuminate\Console\Command;
use App\Notifications\Document\Review;

class CheckDocumentReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-document-review';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find all Documents that needs review and send notification to the responsible person.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Check if time for Document Review');
        $users = [];
        Document::with('owner', 'currentRevision')->chunk(100, function($documents) use (&$users) {
            foreach($documents as $document) {
                if (!$document->currentRevision) {
                    continue;
                }

                if (!$document->owner_id || $document->owner->isAdmin()) {
                    continue;
                }

                $nextReviewDate = $document->nextReviewDate();
                if (!$nextReviewDate) {
                    continue;
                }

                $days = Setting::get('document_notification_before_next_review', 0, $document->owner->currentCompany?->id);
                if ($nextReviewDate->subDays($days)->isFuture()) {
                    continue;
                }

                if (!in_array($document->owner_id, array_keys($users))) {
                    $users[$document->owner_id] = [$document->id];
                } else {
                    $users[$document->owner_id][] = $document->id;
                }
            }

        });

        $users = collect($users);
        if ($users->count() > 0) {
            foreach($users as $userId => $documentIds) {
                $user = \App\Models\User::find($userId);
                $this->info('Documents for ' . $user->name . ': ' . count($documentIds));
                $user->notify(new Review($documentIds));
            }
        }
    }
}
