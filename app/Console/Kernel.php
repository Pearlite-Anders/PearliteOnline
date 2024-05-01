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


        $schedule->command('app:check-welding-certificate-expiration')->daily()->at('09:00')->timezone('Europe/Copenhagen');
        $schedule->command('app:check-welding-certificate-verification')->daily()->at('09:00')->timezone('Europe/Copenhagen');
        $schedule->command('app:send-welding-notifications')->daily()->at('09:30')->timezone('Europe/Copenhagen');

        $schedule->command('backup:run')->daily()->at('01:30');
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
}
