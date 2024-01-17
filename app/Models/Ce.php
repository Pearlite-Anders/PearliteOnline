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
        'execution_standard' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Execution standard',
            'options' => 'ce_execution_standards',
            'placeholder' => 'EN 1090-2',
            'filter' => 'select'
        ],
        'execution_class' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Execution class',
            'options' => 'ce_execution_classes',
            'placeholder' => 'EXC 2',
            'filter' => 'select'
        ],
        'standard' => [
            'type' => 'select',
            'label' => 'Standard',
            'multiple' => false,
            'options' => 'ce_standards',
            'placeholder' => 'EN 1090-1:2009 + A1:2011',
            'filter' => 'select'
        ],
        'scope' => [
            'type' => 'text',
            'label' => 'Scope',
            'placeholder' => 'Opsvejst stålbjælke',
            'filter' => 'search'
        ],
        'tolerance_class' => [
            'type' => 'select',
            'label' => 'Tolerance Class',
            'multiple' => false,
            'options' => 'ce_tolerance_classes',
            'placeholder' => 'Klasse 1',
            'filter' => 'select'
        ],
        'weldability' => [
            'type' => 'select',
            'label' => 'Weldability',
            'multiple' => true,
            'options' => 'ce_weldabilities',
            'placeholder' => 'S235JR',
            'filter' => 'select'
        ],
        'technical_delivery_conditions' => [
            'type' => 'select',
            'label' => 'Technical Delivery Conditions',
            'multiple' => true,
            'options' => 'ce_technical_delivery_conditions',
            'placeholder' => 'EN 10025-2',
            'filter' => 'select'
        ],
        'fracture_toughness' => [
            'type' => 'select',
            'label' => 'Fracture Toughness',
            'multiple' => true,
            'options' => 'ce_fracture_toughnesses',
            'placeholder' => '27J ved 20 °C',
            'filter' => 'select'
        ],
        'behavior_in_fire' => [
            'type' => 'select',
            'label' => 'Behavior in Fire',
            'multiple' => false,
            'options' => 'ce_behavior_in_fires',
            'placeholder' => 'A1',
            'filter' => 'select'
        ],
        'machining_quality' => [
            'type' => 'select',
            'label' => 'Machining Quality',
            'multiple' => false,
            'options' => 'ce_machining_qualities',
            'placeholder' => 'P2',
            'filter' => 'select'
        ],
        'durability' => [
            'type' => 'select',
            'label' => 'Durability',
            'multiple' => false,
            'options' => 'ce_durabilities',
            'placeholder' => 'C3 Middel',
            'filter' => 'select',
            'help' => 'Pre-treatment level is the pre-treatment before surface treatment, for example, before painting.'
        ],
        'load_bearing_capacity' => [
            'type' => 'text',
            'label' => 'Load Bearing Capacity',
            'placeholder' => 'Projektering ifølge EN 1990',
            'filter' => 'search',
            'dependencies' => [
                'method' => ['Method 2', 'Method 3b']
            ]
        ],
        'manufacturing' => [
            'type' => 'text',
            'label' => 'Manufacturing',
            'placeholder' => 'Sagsnummer',
            'filter' => 'search',
            'help' => 'Specify the path to how project planning can be provided, for example, via case number or customer\'s tender material.'
        ],

    ];

    public function loadAll()
    {
        return $this;
    }
}
