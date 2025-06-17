<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WeldingCertificate\CombinedNotifications;

class SendWeldingNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-welding-notifications';

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
        $this->info('Send Welding Notifications');
        Company::with('unreadNotifications')->get()->each(function ($company) {
            if ($company->unreadNotifications->count() > 0) {
                $this->info('Company: ' . $company->data['name']);
                $company->unreadNotifications->markAsRead();

                $users = Setting::get('welding_certificate_notification_users', [], $company->id);
                if (count($users) <= 0) {
                    return;
                }

                $users = User::find($users);

                if (count($users) <= 0) {
                    return;
                }

                foreach ($users as $user) {
                    $this->info('Mail: ' . $user->email);
                    Notification::route('mail', $user->email)->notify(new CombinedNotifications($company->unreadNotifications));
                }
            }
        });

    }
}
