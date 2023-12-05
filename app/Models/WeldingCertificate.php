<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeldingCertificate extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'previous_files' => 'array',
        'data' => 'array'
    ];

    public const SYSTEM_COLUMNS = [
        'certificate' => [
            'type' => 'welding_certificate',
            'label' => 'Certificate',
        ],
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
            'class' => Welder::class,
            'label' => 'Welder',
            'placeholder' => 'Choose user',
            'filter' => 'relationship'
        ],
        'type' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Type',
            'options' => [
                'welding_certificate' => 'Welding certificate',
                'welding_operator_certificate' => 'Welding operator certificate',
            ],
            'placeholder' => 'Choose',
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
            'multiple' => true,
            'label' => 'Welding process',
            'options' => 'welding_processes',
            'placeholder' => '135',
            'filter' => 'select'
        ],
        'plate_pipe' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Plate/pipe',
            'options' => 'plate_pipes',
            'placeholder' => 'P',
            'filter' => 'select'
        ],
        'type_of_weld' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Type of weld',
            'options' => 'type_of_welds',
            'placeholder' => 'FW',
            'filter' => 'select'
        ],
        'material_group' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Material group',
            'options' => 'material_groups',
            'placeholder' => 'FM1',
            'filter' => 'select'
        ],
        'filler_material_type' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Filler material type',
            'options' => 'filler_material_types',
            'placeholder' => 'S',
            'filter' => 'select'
        ],
        'filler_material_group' => [
            'type' => 'select',
            'multiple' => true,
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
            'multiple' => true,
            'label' => 'Shielding gas',
            'options' => 'shielding_gases',
            'placeholder' => 'ss',
            'filter' => 'select'
        ],
        'type_of_current_and_polarity' => [
            'type' => 'select',
            'multiple' => true,
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
            'filter' => 'search'
        ],
        'deposited_thickness' => [
            'type' => 'text',
            'label' => 'Deposited thickness',
            'placeholder' => '12',
            'postfix' => 'mm',
            'filter' => 'search'
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
            'multiple' => true,
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
        'signed' => [
            'type' => 'number',
            'label' => 'Current signatures',
        ],
        'max_signatures' => [
            'type' => 'number',
            'label' => 'Max signatures',
        ],
    ];

    public function welder()
    {
        return $this->belongsTo(Welder::class);
    }

    public function getDateExpirationAttribute()
    {
        if(optional($this->data)['date_examination']) {
            $years_to_add = 3;
            if(optional($this->data)['type'] == 'welding_operator_certificate') {
                $years_to_add = 6;
            }

            $date_examination = Carbon::parse($this->data['date_examination']);
            return $date_examination->addYears($years_to_add)->format('Y.m.d');
        }
        return null;
    }

    public function getDateNextSignatureAttribute()
    {
        if(optional($this->data)['last_signature']) {
            if(preg_match('/^\d{4}-\d{2}-\d{2}$/', optional($this->data)['last_signature'])) {
                return Carbon::parse($this->data['last_signature'])->addMonths(6)->format('Y.m.d');
            } else {
                return Carbon::createFromFormat('Y.m.d', $this->data['last_signature'])->addMonths(6)->format('Y.m.d');
            }
        }
        return null;
    }

}
