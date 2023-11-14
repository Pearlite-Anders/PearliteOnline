<?php

namespace App\Models;

use App\Data\WeldingCertificateData;
use Illuminate\Support\Carbon;
use Kolossal\Multiplex\HasMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeldingCertificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'previous_files' => 'array',
        'data' => 'array'
    ];

    public const SYSTEM_COLUMNS = [
        'number' => [
            'type' => 'text',
            'label' => 'Number',
            'required' => true,
            'placeholder' => '2301502',
            'filter' => 'search'
        ],
        'welder_id' => [
            'type' => 'relationship',
            'relationship' => 'welder',
            'class' => User::class,
            'label' => 'Welder',
            'placeholder' => 'Choose user',
            'filter' => 'select'
        ],
        'designation' => [
            'type' => 'text',
            'label' => 'Designation',
            'placeholder' => 'EN ISO 9606-1 135 P FW FM1 S t12 PE ss nb',
            'filter' => 'search'
        ],
        'welding_process' => [
            'type' => 'select',
            'label' => 'Welding process',
            'options' => 'welding_processes',
            'placeholder' => '135',
            'filter' => 'select'
        ],
        'plate_pipe' => [
            'type' => 'select',
            'label' => 'Plate/pipe',
            'options' => 'plate_pipes',
            'placeholder' => 'P',
            'filter' => 'select'
        ],
        'type_of_weld' => [
            'type' => 'select',
            'label' => 'Type of weld',
            'options' => 'type_of_welds',
            'placeholder' => 'FW',
            'filter' => 'select'
        ],
        'material_group' => [
            'type' => 'select',
            'label' => 'Material group',
            'options' => 'material_groups',
            'placeholder' => 'FM1',
            'filter' => 'select'
        ],
        'filler_material_type' => [
            'type' => 'select',
            'label' => 'Filler material type',
            'options' => 'filler_material_types',
            'placeholder' => 'S',
            'filter' => 'select'
        ],
        'filler_material_group' => [
            'type' => 'select',
            'label' => 'Filler material group',
            'options' => 'filler_material_groups',
            'placeholder' => 't12',
            'filter' => 'select'
        ],
        'filler_material_designation' => [
            'type' => 'text',
            'label' => 'Filler material designation',
            'options' => 'filler_material_designations',
            'placeholder' => 'PE',
            'filter' => 'search'
        ],
        'shielding_gas' => [
            'type' => 'select',
            'label' => 'Shielding gas',
            'options' => 'shielding_gases',
            'placeholder' => 'ss',
            'filter' => 'select'
        ],
        'type_of_current_and_polarity' => [
            'type' => 'select',
            'label' => 'Type of current and polarity',
            'options' => 'type_of_current_and_polarities',
            'placeholder' => 'nb',
            'filter' => 'select'
        ],
        'material_thickness' => [
            'type' => 'text',
            'label' => 'Material thickness',
            'placeholder' => '12',
            'postfix' => 'mm',
            'filter' => 'seach'
        ],
        'deposited_thickness' => [
            'type' => 'text',
            'label' => 'Deposited thickness',
            'placeholder' => '12',
            'postfix' => 'mm',
            'filter' => 'seach'
        ],
        'outside_pip_diameter' => [
            'type' => 'text',
            'label' => 'Outside pip diameter',
            'placeholder' => '12',
            'prefix' => 'Ø',
            'postfix' => 'mm',
            'filter' => 'search'
        ],
        'welding_position' => [
            'type' => 'select',
            'label' => 'Welding position',
            'options' => 'welding_positions',
            'placeholder' => 'PA',
            'filter' => 'select'
        ],
        'weld_details' => [
            'type' => 'text',
            'label' => 'Weld details',
            'placeholder' => '1.2',
            'filter' => 'search'
        ],
        'date_examination' => [
            'type' => 'date',
            'label' => 'Date examination',
            'filter' => 'date'
        ],
        'date_expiration' => [
            'type' => 'calculated',
            'label' => 'Certificate expiration date',
            'filter' => 'date'
        ],
        'last_signature' => [
            'type' => 'date',
            'label' => 'Last signature',
            'filter' => 'date'
        ],
        'date_next_signature' => [
            'type' => 'calculated',
            'label' => 'Date next signature',
            'filter' => 'date'
        ],
        'form.data.signed' => [
            'type' => 'number',
            'label' => 'Current signatures',
        ],
        'form.data.max_signatures' => [
            'type' => 'number',
            'label' => 'Max signatures',
        ],
    ];

    public static function getDefaultColumns()
    {
        $order = 0;
        return collect(self::SYSTEM_COLUMNS)->map(function ($column, $index) use (&$order) {
            return (object)[
                'key' => $index,
                'label' => $column['label'],
                'visible' => true,
                'order' => $order++,
            ];
        })->values();
    }

    public static function getColumn($key)
    {
        $column =  (object)self::SYSTEM_COLUMNS[$key];
        $column->key = $key;
        return $column;
    }

    public static function getDefaultFilters()
    {
        $order = 0;
        return collect(self::SYSTEM_COLUMNS)->map(function ($column, $index) use (&$order) {
            return (object)[
                'key' => $index,
                'label' => $column['label'],
                'order' => $order++,
            ];
        })->values();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function welder()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateExpirationAttribute()
    {
        if(optional($this->data)['date_examination']) {
            $date_examination = Carbon::parse($this->data['date_examination']);
            return $date_examination->addYears(3)->format('Y.m.d');
        }
        return null;
    }

}
