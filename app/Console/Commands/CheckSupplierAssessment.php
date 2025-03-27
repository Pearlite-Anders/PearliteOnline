<?php

namespace App\Console\Commands;

use App\Models\Supplier;
use Illuminate\Console\Command;
use App\Models\Setting;
use App\Models\WeldingCertificate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Supplier\Assessment;

class CheckSupplierAssessment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-supplier-assessment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find all suppliers that needs assessment and send notification to the responsible person.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Check if time for Supplier Assessment');

        $users = [];
        Supplier::with('responsible_user')->chunk(100, function($suppliers) use (&$users) {
            foreach($suppliers as $supplier) {
                if (($supplier->data["needs_assessment"] ?? true) == "no" ) {
                    continue;
                }

                if (!$supplier->responsible_user) {
                    continue;
                }

                $nextAssessmentDate = $supplier->nextAssessment();
                if (!$nextAssessmentDate) {
                    continue;
                }

                $days = Setting::get('supplier_notification_before_next_assessment', 0, $supplier->responsible_user->currentCompany?->id);
                if ($nextAssessmentDate->subDays($days)->isFuture()) {
                    $this->info($nextAssessmentDate->format('Y-m-d'));
                    continue;
                }

                if (!in_array($supplier->responsible_user->id, array_keys($users))) {
                    $users[$supplier->responsible_user->id] = [$supplier->id];
                } else {
                    $users[$supplier->responsible_user->id][] = $supplier->id;
                }
            }

        });

        $users = collect($users);
        if ($users->count() > 0) {
            foreach($users as $userId => $suppliers) {
                $user = \App\Models\User::find($userId);
                $this->info('Suppliers for ' . $user->name . ': ' . count($suppliers));
                $user->notify(new Assessment($suppliers));
            }
        }
    }
}
