<?php

namespace App\Console\Commands;

use App\Notifications\UserSummary;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendUserSummaryNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-user-summary-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Send User Summary Notifications');
        User::with('unreadNotifications')->whereHas('unreadNotifications')->chunk(100, function($users) {
            foreach($users as $user) {
                if ($user->unreadNotifications->count() > 0) {
                    $this->info('User: ' . $user->name);

                    $supplierAssessmentsNotification = $user->unreadNotifications->where('type', 'App\Notifications\Supplier\Assessment')->last();
                    $machineMaintenanceNotication = $user->unreadNotifications->where('type', 'App\Notifications\MachineMaintenance\Maintenance')->last();

                    $user->notify(
                        new UserSummary(
                            $supplierAssessmentsNotification,
                            $machineMaintenanceNotication
                        )
                    );
                    $user->unreadNotifications->markAsRead();
                }
            }
        });

    }
}
