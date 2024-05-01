<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Setting;
use Illuminate\Console\Command;
use App\Models\WeldingCertificate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WeldingCertificate\Verification;

class CheckWeldingCertificateVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-welding-certificate-verification';

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
        $this->info('Check Welding Certificate Verification');

        Company::all()->each(function ($company) {
            $this->info('Company: ' . $company->data['name']);
            $notification_before_verification = Setting::get('welding_certificate_notification_before_verification', null, $company->id);

            $weldingCertificates = WeldingCertificate::query()
                ->whereCompanyId($company->id)
                ->where(
                    'data->last_signature',
                    now()
                        ->addDays($notification_before_verification)
                        ->subMonths(6)
                        ->format('Y.m.d')
                )
                ->get();

            if ($weldingCertificates->count() > 0) {
                $this->info('Welding Certificates: ' . $weldingCertificates->count());
                $company->notify(new Verification($weldingCertificates->pluck('id'), $notification_before_verification));

                // $mails = Setting::get('welding_certificate_notification_email', null, $weldingCertificates->first()->company_id);
                // $mails = explode(',', $mails);
                // $mails = array_map('trim', $mails);
                // foreach ($mails as $mail) {
                //     $this->info('Mail: ' . $mail);
                //     Notification::route('mail', $mail)->notify(new Verification($weldingCertificates, $notification_before_verification));
                // }
            }
        });
    }
}
