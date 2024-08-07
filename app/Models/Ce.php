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

        'tolerance_class' => [
            'type' => 'select',
            'label' => 'Tolerance Class',
            'multiple' => false,
            'options' => 'ce_tolerance_classes',
            'placeholder' => 'Select - Example: Klasse 1',
            'filter' => 'select',
            'help' => 'Specify tolerance class'
        ],

        'scope' => [
            'type' => 'text',
            'label' => 'Scope',
            'placeholder' => 'Opsvejst stålbjælke',
            'filter' => 'search',
            'help' => 'Describe what the CE mark includes'
        ],
        'weldability_group' => [
            'type' => 'group',
            'label' => 'Weldability',
            'multiple' => true,
            'fields' => [
                'weldability' => [
                    'type' => 'select',
                    'label' => 'Weldability',
                    'multiple' => false,
                    'options' => 'ce_weldability_group',
                    'placeholder' => 'Select',
                    'filter' => 'select',
                ],
                'fracture_toughness' => [
                    'type' => 'select',
                    'label' => 'Facture toughness',
                    'multiple' => false,
                    'options' => 'ce_facture_toughness',
                    'placeholder' => 'Select - Example: S235',
                    'filter' => 'select'
                ],
            ],
            'filter' => 'search',
            'help' => 'Specify the types of steel used',
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

        'durability_group' => [
            'type' => 'group',
            'label' => 'Durability',
            'multiple' => true,
            'fields' => [
                'surface' => [
                    'type' => 'select',
                    'label' => 'Surface treatment',
                    'multiple' => false,
                    'options' => 'ce_surface',
                    'placeholder' => 'Surface treatment',
                    'filter' => 'select',
                ],
                'corrosivity_category' => [
                    'type' => 'select',
                    'label' => 'Corrosivity category',
                    'multiple' => false,
                    'options' => [
                        'C1' => 'C1',
                        'C2' => 'C2',
                        'C3' => 'C3',
                        'C4' => 'C4',
                        'C5' => 'C5',
                        'npd' => 'NPD'
                    ],
                    'placeholder' => 'Corrosivity category',
                    'filter' => 'select',
                ],
                'expected_durability' => [
                    'type' => 'select',
                    'label' => 'Expected durability',
                    'multiple' => false,
                    'options' => [
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                        'NPD' => 'NPD'
                    ],
                    'placeholder' => 'Expected durability',
                    'filter' => 'select',
                ],
                'prepration_grade' => [
                    'type' => 'select',
                    'label' => 'Prepration grade',
                    'multiple' => false,
                    'options' => [
                        'P1' => 'P1',
                        'P2' => 'P2',
                        'P3' => 'P3',
                        'NPD' => 'NPD',
                    ],
                    'placeholder' => 'Prepration grade',
                    'filter' => 'select',
                ],
            ],
            'filter' => 'search',
            'help' => 'Specify the types of steel used',
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
