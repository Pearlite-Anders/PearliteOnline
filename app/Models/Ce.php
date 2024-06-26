<?php

namespace App\Models;

use App\Data\ProjectData;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ce extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public const LABEL_KEY = 'data.name';

    public const SYSTEM_COLUMNS = [
        'project_id' => [
            'type' => 'relationship',
            'relationship' => 'project',
            'class' => Project::class,
            'label' => 'Project',
            'placeholder' => 'Choose project',
            'filter' => 'relationship',
            'create_popup' => true,
            'data_class' => ProjectData::class,
        ],
        'method' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Method',
            'placeholder' => 'Select',
            'options' => [
                'Method 1' => 'Method 1',
                'Method 2' => 'Method 2',
                'Method 3a' => 'Method 3a',
                'Method 3b' => 'Method  3b',
            ],
            'filter' => 'radios'
        ],
        'date' => [
            'type' => 'date',
            'label' => 'Date',
            'placeholder' => 'Select',
            'filter' => 'date',
        ],
        'execution_standard' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Execution standard',
            'options' => 'ce_execution_standards',
            'placeholder' => 'Select - Example: EN 1090-2',
            'filter' => 'select',
            'help' => 'Specify the execution class, for example, EXC2',
        ],
        'standard' => [
            'type' => 'select',
            'label' => 'Standard',
            'multiple' => false,
            'options' => 'ce_standards',
            'placeholder' => 'Select - Example: EN 1090-1:2009 + A1:2011',
            'filter' => 'select',
            'help' => 'Execution standard',
        ],
        'execution_class' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Execution class',
            'options' => 'ce_execution_classes',
            'placeholder' => 'Select - Example: EXC 2',
            'filter' => 'select',
            'help' => 'Specify the execution standard, for example, EN 1090-2',
        ],

        'scope' => [
            'type' => 'text',
            'label' => 'Scope',
            'placeholder' => 'Opsvejst stålbjælke',
            'filter' => 'search',
            'help' => 'Describe what the CE mark includes'
        ],
        'weldability_group' => [
            'type' => 'select',
            'label' => 'Weldability',
            'multiple' => false,
            'options' => 'ce_weldability_group',
            'placeholder' => 'Select',
            'filter' => 'select',
            'help' => 'Specify the types of steel used',
        ],
        'tolerance_class' => [
            'type' => 'select',
            'label' => 'Tolerance Class',
            'multiple' => false,
            'options' => 'ce_tolerance_classes',
            'placeholder' => 'Select - Example: Klasse 1',
            'filter' => 'select',
            'help' => 'Specify tolerance class'
        ],
        'behavior_in_fire' => [
            'type' => 'select',
            'label' => 'Reaction to fire',
            'multiple' => false,
            'options' => 'ce_behavior_in_fires',
            'placeholder' => 'Select - Example: A1',
            'filter' => 'select',
            'help' => 'Specify the Material Classification, for example, class “A1”',
        ],
        'surface' => [
            'type' => 'select',
            'label' => 'Surface',
            'multiple' => false,
            'options' => [
                'paint' => 'Paint (EN 12944)',
                'galvanization' => 'Galvanizing (EN 1461)',
                'untreated' => 'Untreated',
            ],
            'placeholder' => 'Select',
            'filter' => 'select',
        ],
        'durability' => [
            'type' => 'select',
            'label' => 'Durability',
            'multiple' => false,
            'options' => [
                'C1 Lav' => 'C1 Lav',
                'C1 Middel' => 'C1 Middel',
                'C1 Høj' => 'C1 Høj',
                'C2 Lav' => 'C2 Lav',
                'C2 Middel' => 'C2 Middel',
                'C2 Høj' => 'C2 Høj',
                'C3 Lav' => 'C3 Lav',
                'C3 Middel' => 'C3 Middel',
                'C3 Høj' => 'C3 Høj',
                'C4 Lav' => 'C4 Lav',
                'C4 Middel' => 'C4 Middel',
                'C4 Høj' => 'C4 Høj',
                'C5 Lav' => 'C5 Lav',
                'C5 Middel' => 'C5 Middel',
                'C5 Høj' => 'C5 Høj',
                'npd' => 'NPD',
            ],
            'placeholder' => 'Select - Example: C3 Middel',
            'filter' => 'select',
            'help' => 'Pre-treatment level is the pre-treatment before surface treatment, for example, before painting.',
            'dependencies' => [
                'surface' => ['paint', 'galvanization'],
            ],
        ],
        'machining_quality' => [
            'type' => 'select',
            'label' => 'Prepration grade',
            'multiple' => false,
            'options' => [
                'P1' => 'P1',
                'P2' => 'P2',
                'P3' => 'P3',
                'npd' => 'NPD',
            ],
            'placeholder' => 'Select - Example: P2',
            'filter' => 'select',
            'dependencies' => [
                'surface' => ['paint', 'galvanization'],
            ],
        ],
        'load_bearing_capacity' => [
            'type' => 'system_text',
            'default' => 'NPD',
            'npd_button' => true,
            'label' => 'Load Bearing Capacity',
            'placeholder' => 'Projektering ifølge EN 1990',
            'filter' => 'search',
        ],
        'deformation_serviceability_limit_state' => [
            'type' => 'system_text',
            'default' => 'NPD',
            'npd_button' => true,
            'label' => 'Deformation at Serviceability Limit State',
            'placeholder' => '',
            'filter' => 'search',
        ],
        'fatigue_strength' => [
            'type' => 'system_text',
            'default' => 'NPD',
            'npd_button' => true,
            'label' => 'Fatigue Strength',
            'placeholder' => '',
            'filter' => 'search',
        ],
    ];

    public function loadAll()
    {
        return $this;
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
