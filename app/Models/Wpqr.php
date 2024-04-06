<?php

namespace App\Models;

use App\Data\ProjectData;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wpqr extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public const LABEL_KEY = 'data.name';

    public const SYSTEM_COLUMNS = [
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
        'name' => [
            'type' => 'text',
            'label' => 'WPQR name',
            'required' => true,
            'placeholder' => '135-BW-sl',
            'filter' => 'search'
        ],
        'standard' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Standard',
            'options' => 'wpqr_standards',
            'placeholder' => 'EN 15614-1',
            'filter' => 'select'
        ],
        'welding_process' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Welding process',
            'options' => 'welding_processes',
            'placeholder' => '135',
            'filter' => 'select'
        ],
        'type_of_joint' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Type of joint',
            'options' => 'type_of_joints',
            'placeholder' => 'FW',
            'filter' => 'select'
        ],
        'throat_thickness' => [
            'type' => 'text',
            'label' => 'Throat thickness',
            'placeholder' => '5',
            'filter' => 'search'
        ],
        'type_of_joint_preparation' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Type of joint preparation',
            'options' => 'type_of_joint_preparations',
            'placeholder' => 'V',
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
        'thickness_1' => [
            'type' => 'text',
            'label' => 'Thickness 1',
            'placeholder' => '25',
            'postfix' => 'mm',
            'filter' => 'search'
        ],
        'thickness_2' => [
            'type' => 'text',
            'label' => 'Thickness 2',
            'placeholder' => '10',
            'postfix' => 'mm',
            'filter' => 'search'
        ],
        'material_group' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Material group',
            'options' => 'material_groups',
            'placeholder' => '1.1',
            'filter' => 'select'
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
        'filler_material_designation' => [
            'type' => 'text',
            'label' => 'Filler material designation',
            'placeholder' => 'G42 4 M21 3Si1',
            'filter' => 'search'
        ],
        'filler_material_size' => [
            'type' => 'text',
            'label' => 'Filler material size',
            'placeholder' => '0.8',
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
        'layers' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Layers',
            'options' => 'layers',
            'placeholder' => 'sl',
            'filter' => 'select'
        ],
        'preheat_temperature' => [
            'type' => 'text',
            'label' => 'Preheat temperature',
            'placeholder' => '50',
            'postfix' => '°C',
            'filter' => 'search'
        ],
        'interpass_temperature' => [
            'type' => 'text',
            'label' => 'Interpass temperature',
            'placeholder' => '220',
            'postfix' => '°C',
            'filter' => 'search'
        ],
        'outer_pipe_diameter' => [
            'type' => 'text',
            'label' => 'Outer pipe diameter',
            'placeholder' => '220',
            'prefix' => 'ø',
            'postfix' => 'mm',
            'filter' => 'search'
        ],
        'heat_input' => [
            'type' => 'text',
            'label' => 'Heat input',
            'placeholder' => '0.71-1.12',
            'postfix' => 'Kj/mm',
            'filter' => 'search'
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

    public function loadAll()
    {
        return $this->load(['company']);
    }
}
