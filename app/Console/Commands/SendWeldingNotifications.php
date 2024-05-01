<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Setting;
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

                $mails = Setting::get('welding_certificate_notification_email', null, $company->id);
                $mails = explode(',', $mails);
                $mails = array_map('trim', $mails);
                foreach ($mails as $mail) {
                    $this->info('Mail: ' . $mail);
                    Notification::route('mail', $mail)->notify(new CombinedNotifications($company->unreadNotifications));
                }
            }
        });

    }
}
