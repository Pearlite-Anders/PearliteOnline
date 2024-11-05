<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $this->userNotifications($schedule);
        $this->companyNotifications($schedule);

        $schedule->command('app:send-user-summary-notifications')->everyThirtyMinutes()->timezone('Europe/Copenhagen');
        $schedule->command('app:send-welding-notifications')->daily()->at('09:30')->timezone('Europe/Copenhagen');

        $schedule->command('backup:run')->daily()->at('01:30');
        $schedule->command('backup:clean')->daily()->at('02:30');
        $schedule->command('backup:monitor')->daily()->at('03:00');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
    * Schedule all the commands to fetch notifications for users.
    */
    protected function userNotifications(Schedule $schedule): void
    {
        $schedule->command('app:check-document-review')->daily()->at('09:00')->timezone('Europe/Copenhagen');
        $schedule->command('app:check-machine-maintenance')->daily()->at('09:00')->timezone('Europe/Copenhagen');
        $schedule->command('app:check-supplier-assessment')->daily()->at('09:00')->timezone('Europe/Copenhagen');
    }

    /**
    * Schedule all the commands to fetch notifications for company.
    */
    protected function companyNotifications(Schedule $schedule): void
    {
        $schedule->command('app:check-welding-certificate-expiration')->daily()->at('09:00')->timezone('Europe/Copenhagen');
        $schedule->command('app:check-welding-certificate-verification')->daily()->at('09:00')->timezone('Europe/Copenhagen');
    }
}
