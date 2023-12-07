<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function value(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if (is_string($value) && json_decode($value, true)) {
                    return json_decode($value, true);
                }

                return $value;
            },
            set: function ($value) {
                if (is_array($value)) {
                    return json_encode($value);
                }

                return $value;
            }
        );
    }

    public static function all($columns = ['*'])
    {
        $database_settings = self::whereCompanyId(auth()->user()->currentCompany->id)->get()->mapWithKeys(function ($setting) {
            return [$setting->key => $setting->value];
        });
        return self::default()->merge($database_settings);
    }

    public static function get($key, $deault = null, $company_id = null)
    {
        $company_id = $company_id ?? auth()->user()->currentCompany->id;
        $database_value = self::whereCompanyId($company_id)->where('key', $key)->first();
        if($database_value) {
            return $database_value->value;
        }

        $value = self::default()->get($key);
        if($value) {
            return $value;
        }

        return $deault;
    }

    public static function default()
    {
        return collect([
            'welding_certificate_notification_before_expiration' => 14,
            'welding_certificate_notification_before_verification' => 7,
            'welding_processes' => [
                '111' => '111',
                '131' => '131',
                '135' => '135',
                '136' => '136',
                '138' => '138',
                '141' => '141',
                '142' => '142',
                '143' => '143',
                '783' => '783',
            ],
            'plate_pipes' => [
                'P' => 'P',
                'T' => 'T',
                'P_T' => 'P/T',
            ],
            'type_of_welds' => [
                'FW' => 'FW',
                'BW' => 'BW',
            ],
            'material_groups' => [
                '1_1' => '1.1',
                '1_2' => '1.2',
                '1_3' => '1.3',
                '1_4' => '1.4',
                '8_1' => '8.1',
                '8_2' => '8.2',
            ],
            'filler_material_types' => [
                'A' => 'A - Sur',
                'B' => 'B - Basisk',
                'C' => 'C - Cellulose',
                'R' => 'R - Rutil',
                'RA' => 'RA - Rutil sur',
                'RB' => 'RB - Rutil Basisk',
                'RC' => 'RC - Rutil Cellulose',
                'RR' => 'RR - Rutil (tyk beklædning)',
                'S' => 'S - Massiv tråd',
                'M' => 'M - Metalfyldt rørtråd',
                'P' => 'P - Rutil hurtig størknende',
                'V' => 'V - Rutil eller basisk/fluorid',
                'W' => 'W - Basisk/fluorid',
                'Z' => 'Z - Andre type',
                'nm' => 'nm - Intet tilsatsmateriale',
            ],
            'filler_material_groups' => [
                'FM1' => 'FM1',
                'FM2' => 'FM2',
                'FM3' => 'FM3',
                'FM4' => 'FM4',
                'FM5' => 'FM5',
                'FM6' => 'FM6',
            ],
            'shielding_gases' => [
                'I1' => 'I1',
                'M20' => 'M20',
                'M21' => 'M21',
            ],
            'type_of_current_and_polarities' => [
                'DC_plus' => 'DC+',
                'DC_minus' => 'DC-',
                'AC' => 'AC',
            ],
            'welding_positions' => [
                'PA' => 'PA',
                'PB' => 'PB',
                'PC' => 'PC',
                'PD' => 'PD',
                'PE' => 'PE',
                'PF' => 'PF',
                'PG' => 'PG',
                'PH' => 'PH',
                'PJ' => 'PJ',
                'HL-045' => 'HL-045',
                'JL-045' => 'JL-045',
            ],
            'weld_detailses' => [
                'ss_nb' => 'ss nb',
                'ss_mb' => 'ss mb',
                'bs' => 'bs',
                'ss_gb' => 'ss gb',
                'ss_fb' => 'ss fb',
                'sl' => 'sl',
                'ml' => 'ml',
            ],
            'type_of_joints' => [
                'FW' => 'FW',
                'BW' => 'BW',
            ],
            'type_of_joint_preparations' => [
                'V' => 'V',
                'K' => 'K',
                'Y' => 'Y',
            ],
            'layers' => [
                'sl' => 'sl',
                'ml' => 'ml',
            ],
            'wpqr_standards' => [
                'EN 15614-1' => 'EN 15614-1',
                'EN 15613' => 'EN 15613',
                'EN 15612' => 'EN 15612',
                'EN 15611' => 'EN 15611',
                'EN 15610' => 'EN 15610',
            ]
        ]);
    }

}
