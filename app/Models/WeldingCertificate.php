<?php

namespace App\Models;

use App\Data\ProjectData;
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
        'file' => [
            'type' => 'file',
            'label' => 'Preview',
        ],
        'projects' => [
            'type' => 'relationship',
            'relationship' => 'projects',
            'class' => Project::class,
            'label' => 'Projects',
            'placeholder' => 'Choose project',
            'filter' => 'relationship',
            'create_popup' => true,
            'data_class' => ProjectData::class,
            'multiple' => true,
            'hidden' => true
        ],
        'type' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Type',
            'options' => [
                'welding_certificate' => 'Welding certificate EN 9606',
                'welding_operator_certificate' => 'Welding operator certificate EN 14732',
            ],
            'placeholder' => 'Choose',
            'filter' => 'select'
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
            'placeholder' => '1.1',
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
            'placeholder' => 'FM1',
            'filter' => 'select'
        ],
        'filler_material_designation' => [
            'type' => 'text',
            'label' => 'Filler material designation',
            'options' => 'filler_material_designations',
            'placeholder' => 'G 42 3 M21 3Si1',
            'filter' => 'search'
        ],
        'shielding_gas' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Shielding gas',
            'options' => 'shielding_gases',
            'placeholder' => 'M21',
            'filter' => 'select'
        ],
        'type_of_current_and_polarity' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Type of current and polarity',
            'options' => 'type_of_current_and_polarities',
            'placeholder' => 'DC+',
            'filter' => 'select'
        ],
        'material_thickness' => [
            'type' => 'text',
            'label' => 'Material thickness',
            'placeholder' => '12',
            'postfix' => 'mm',
            'filter' => 'search_number'
        ],
        'deposited_thickness' => [
            'type' => 'text',
            'label' => 'Deposited thickness',
            'placeholder' => '12',
            'postfix' => 'mm',
            'filter' => 'search_number'
        ],
        'outside_pip_diameter' => [
            'type' => 'text',
            'label' => 'Outside pip diameter',
            'placeholder' => '12',
            'prefix' => 'Ø',
            'postfix' => 'mm',
            'filter' => 'search_number'
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
            'type' => 'select',
            'multiple' => true,
            'label' => 'Weld details',
            'options' => 'weld_detailses',
            'placeholder' => 'ss nb',
            'filter' => 'search'
        ],
        'date_examination' => [
            'type' => 'date',
            'label' => 'Date examination',
            'filter' => 'date'
        ],
        'date_expiration' => [
            'type' => 'date',
            'label' => 'Certificate expiration date',
            'filter' => 'date'
        ],
        'last_signature' => [
            'type' => 'date',
            'label' => 'Last signature',
            'filter' => 'date'
        ],
        'date_next_signature' => [
            'type' => 'date',
            'label' => 'Date next signature',
            'filter' => 'date',
            'indicator' => true
        ],
        'signed' => [
            'type' => 'number',
            'label' => 'Current signatures',
        ],
        'status' => [
            'type' => 'radios',
            'multiple' => false,
            'label' => 'Active/Inactive',
            'options' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
            ],
            'filter' => 'radios',
            'default' => 'active'
        ],
        'remarks' => [
            'type' => 'textarea',
            'label' => 'Remarks',
            'filter' => 'search'
        ],
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function welder()
    {
        return $this->belongsTo(Welder::class);
    }

    public function loadAll()
    {
        return $this->load(['company', 'welder']);
    }

    public function getNextSignatureOrExpireAttribute()
    {
        $next = $this->nextSignatureOrExpire();
        return $next ? $next->format('Y.m.d') : null;
    }

    public function getLatestSignatureAttribute()
    {
        $latest_signature = $this->latestSignature();
        return $latest_signature? $latest_signature->format('Y.m.d') : null;
    }

    public function nextSignatureOrExpire()
    {
        $dates = [];
        if (data_get($this->data, 'date_next_signature', '') != '') {
            $dates[] = Carbon::createFromFormat('Y.m.d', $this->data['date_next_signature']);
        }

        if (data_get($this->data, 'date_expiration', '') != '') {
            $dates[] = Carbon::createFromFormat('Y.m.d', $this->data['date_expiration']);
        }

        if (count($dates) == 0) {
            return null;
        }

        uasort($dates, function ($a, $b) {
            if ($a->eq($b)) {
                return 0;
            }
            return ($a->isBefore($b)) ? -1 : 1;
        });

        return $dates[0];
    }

    public function latestSignature()
    {
        if (data_get($this->data, 'last_signature', '') == '') {
            return null;
        }

        $date = str_replace('-', '.', $this->data['last_signature']);
        return Carbon::createFromFormat('Y.m.d', $date);
    }

    public function edit_url()
    {
        return route('welding-certificates.edit', ['weldingCertificate' => $this->id]);
    }

    public function getNeedsReviewAttribute()
    {
        return isset($this->data['status']) && $this->data['status'] == 'active';
    }
}
