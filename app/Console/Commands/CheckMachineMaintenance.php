<?php

namespace App\Console\Commands;

use App\Models\MachineMaintenance;
use Illuminate\Console\Command;
use App\Models\WeldingCertificate;
use App\Models\Setting;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Supplier\Assessment;
use App\Notifications\MachineMaintenance\Maintenance;

class CheckMachineMaintenance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-machine-maintenance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find all MachineMaintenance that needs maintenance and send notification to the responsible person.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Check if time for Maintenance');

        $users = [];
        MachineMaintenance::with('responsible_user')->chunk(100, function($machines) use (&$users) {
            foreach($machines as $machine) {
                if (!$machine->responsible_user) {
                    continue;
                }

                $nextMaintenanceDate = $machine->nextMaintenanceDate();
                if (!$nextMaintenanceDate) {
                    continue;
                }

                $days = Setting::get('maintenance_notification_before_next_maintenance', 0, $machine->responsible_user->currentCompany?->id);
                if ($nextMaintenanceDate->subDays($days)->isFuture()) {
                    continue;
                }

                if (!in_array($machine->responsible_user->id, array_keys($users))) {
                    $users[$machine->responsible_user->id] = [$machine->id];
                } else {
                    $users[$machine->responsible_user->id][] = $machine->id;
                }
            }

        });

        $users = collect($users);
        if ($users->count() > 0) {
            foreach($users as $userId => $maintenancesIds) {
                $user = \App\Models\User::find($userId);
                $this->info('MachineMaintenance for ' . $user->name . ': ' . count($maintenancesIds));
                $user->notify(new Maintenance($maintenancesIds));
            }
        }
    }
}
