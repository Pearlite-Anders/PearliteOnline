<?php

namespace Database\Scripts;

use App\Models\TimeRegistration;
use Illuminate\Support\Str;

class SetTimeRegistrationHoursToDecimal
{
    public static function handle()
    {
        TimeRegistration::orderBy('id')->chunk(100, function ($registrations) {
            foreach ($registrations as $registration) {
                $hours = data_get($registration->data, 'hours', null);
                if ($hours == null || !Str::contains($hours, ':')) {
                    continue;
                }

                [$hours, $minutes] = explode(":", $hours);


                $hours = floatval($hours);
                $hours = $hours + (intval($minutes) / 60);
                $hours = round($hours, 2);
                $hours = str_replace(".", ",", $hours);

                $data = $registration->data;
                $data['hours'] = $hours;
                $registration->data = $data;
                $registration->save();
            }
        });
    }
}
