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
        'execution_class' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Execution class',
            'options' => 'ce_execution_classes',
            'placeholder' => 'Select - Example: EXC 2',
            'filter' => 'select',
            'help' => 'Specify the execution standard, for example, EN 1090-2',
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
        'scope' => [
            'type' => 'text',
            'label' => 'Scope',
            'placeholder' => 'Opsvejst stålbjælke',
            'filter' => 'search',
            'help' => 'Describe what the CE mark includes'
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
        'weldability' => [
            'type' => 'select',
            'label' => 'Weldability',
            'multiple' => true,
            'options' => 'ce_weldabilities',
            'placeholder' => 'S235JR',
            'filter' => 'select',
            'help' => 'Specify the types of steel used',
        ],
        'technical_delivery_conditions' => [
            'type' => 'select',
            'label' => 'Technical Delivery Conditions',
            'multiple' => true,
            'options' => 'ce_technical_delivery_conditions',
            'placeholder' => 'Select - Example: EN 10025-2',
            'filter' => 'select',
            'help' => 'Specify the standard for technical delivery conditions, for example, EN 10025-2',
        ],
        'fracture_toughness' => [
            'type' => 'select',
            'label' => 'Fracture Toughness',
            'multiple' => true,
            'options' => 'ce_fracture_toughnesses',
            'placeholder' => 'Select - Example: 27J ved 20 °C',
            'filter' => 'select',
            'help' => 'Specify the toughness',
        ],
        'behavior_in_fire' => [
            'type' => 'select',
            'label' => 'Behavior in Fire',
            'multiple' => false,
            'options' => 'ce_behavior_in_fires',
            'placeholder' => 'Select - Example: A1',
            'filter' => 'select',
            'help' => 'Specify the Material Classification, for example, class “A1”',
        ],
        'machining_quality' => [
            'type' => 'select',
            'label' => 'Machining Quality',
            'multiple' => false,
            'options' => 'ce_machining_qualities',
            'placeholder' => 'Select - Example: P2',
            'filter' => 'select'
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
            'options' => 'ce_durabilities',
            'placeholder' => 'Select - Example: C3 Middel',
            'filter' => 'select',
            'help' => 'Pre-treatment level is the pre-treatment before surface treatment, for example, before painting.'
        ],
        'load_bearing_capacity' => [
            'type' => 'text',
            'label' => 'Load Bearing Capacity',
            'placeholder' => 'Projektering ifølge EN 1990',
            'filter' => 'search',
        ],
        'dimensioning' => [
            'type' => 'text',
            'label' => 'Dimensioning',
            'placeholder' => '',
            'filter' => 'search',
        ],
        'carrying_capacity' => [
            'type' => 'text',
            'label' => 'Carrying Capacity',
            'placeholder' => '',
            'filter' => 'search',
        ],
        'deformation_service_limit_state' => [
            'type' => 'text',
            'label' => 'Deformation in the Service Limit State',
            'placeholder' => '',
            'filter' => 'search',
        ],
        'fatigue_strength' => [
            'type' => 'text',
            'label' => 'Fatigue Strength',
            'placeholder' => '',
            'filter' => 'search',
        ],
        'fire_resistance' => [
            'type' => 'text',
            'label' => 'Fire Resistance',
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
