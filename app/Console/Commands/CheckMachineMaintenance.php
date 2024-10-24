<?php

namespace App\Console\Commands;

use App\Models\MachineMaintenance;
use Illuminate\Console\Command;
use App\Models\WeldingCertificate;
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
        $maintenances = MachineMaintenance::whereNotNull('data->lastest_maintenance_date')
            ->whereNotNull('data->maintenance_interval')
            ->whereNotNull('responsible_user_id')
            ->whereRaw(
                "CURDATE() > DATE_ADD(STR_TO_DATE(JSON_UNQUOTE(data->'$.lastest_maintenance_date'), '%Y.%m.%d'), INTERVAL JSON_UNQUOTE(data->'$.maintenance_interval') MONTH)"
            )
            ->get();

        $users = $maintenances->groupBy(function($maintenance) {
            return $maintenance->responsible_user_id;
        });

        if ($users->count() > 0) {
            foreach($users as $userId => $maintenances) {
                $user = \App\Models\User::find($userId);
                $this->info('MachineMaintenance for ' . $user->name . ': ' . count($maintenances));
                $user->notify(new Maintenance($maintenances->pluck('id')->toArray()));
            }
        }
    }
}
