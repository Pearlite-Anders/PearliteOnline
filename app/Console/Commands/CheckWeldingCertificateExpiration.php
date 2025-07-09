<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Setting;
use Illuminate\Console\Command;
use App\Models\WeldingCertificate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WeldingCertificate\Expiration;

class CheckWeldingCertificateExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-welding-certificate-expiration';

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
        $this->info('Check Welding Certificate Expiration');

        Company::all()->each(function ($company) {
            $this->info('Company: ' . $company->data['name']);
            $notification_before_expiration = Setting::get('welding_certificate_notification_before_expiration', 14, $company->id);

            $weldingCertificates = WeldingCertificate::query()
                ->whereCompanyId($company->id)
                ->where(function ($dates) use ($notification_before_expiration) {
                    $dates->where(function ($query) use ($notification_before_expiration) {
                        $query->where(
                            'data->date_examination',
                            now()
                                ->addDays($notification_before_expiration)
                                ->subYears(3)
                                ->format('Y.m.d')
                        );
                        $query->where(
                            'data->type',
                            'welding_certificate'
                        );
                    })
                    ->orWhere(function ($query) use ($notification_before_expiration) {
                        $query->where(
                            'data->date_examination',
                            now()
                                ->addDays($notification_before_expiration)
                                ->subYears(6)
                                ->format('Y.m.d')
                        );
                        $query->where(
                            'data->type',
                            'welding_operator_certificate'
                        );
                    });
                })
                ->get();

            $this->info('Welding Certificates: ' . $weldingCertificates->count());

            if ($weldingCertificates->count() > 0) {
                $this->info('Welding Certificates: ' . $weldingCertificates->count());
                $company->notify(new Expiration($weldingCertificates->pluck('id'), $notification_before_expiration));
            }
        });
    }
}
