<?php

namespace App\Models;

use App\Models\Trait\HasCompany;
use App\Models\Trait\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class RoutineInspection extends Model
{
    use HasFactory, HasCompany, HasFilter;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'images' => 'array',
        'files' => 'array',
    ];

    public const LABEL_KEY = 'data.name';

    public const SYSTEM_COLUMNS = [
        'date' => [
            'type' => 'date',
            'label' => 'Date',
            'filter' => 'date'
        ],
        'wps_id' => [
            'type' => 'relationship',
            'relationship' => 'wps',
            'class' => Wps::class,
            'label' => 'WPS',
            'placeholder' => 'Choose WPS',
            'filter' => 'relationship'
        ],
        'project_id' => [
            'type' => 'relationship',
            'relationship' => 'project',
            'class' => Project::class,
            'label' => 'Project no.',
            'placeholder' => 'Choose project',
            'filter' => 'relationship'
        ],
        'execution_class' => [
            'type' => 'radios',
            'label' => 'Execution class',
            'options' => [
                'EXC 1' => 'EXC 1',
                'EXC 2' => 'EXC 2',
                'EXC 3' => 'EXC 3',
                'EXC 4' => 'EXC 4',
            ],
            'filter' => 'search'
        ],
        'drawing' => [
            'type' => 'text',
            'label' => 'Drawing no',
            'filter' => 'search'
        ],
        'weld_length' => [
            'type' => 'text',
            'label' => 'Weld length',
            'placeholder' => '5',
            'postfix' => 'cm',
            'filter' => 'search'
        ],
        'inspected_length' => [
            'type' => 'text',
            'label' => 'Inspected length',
            'placeholder' => '3',
            'postfix' => 'cm',
            'filter' => 'search'
        ],
        'inspected_scope' => [
            'type' => 'text',
            'label' => 'Inspected scope',
            'placeholder' => '20',
            'postfix' => '%',
            'filter' => 'search'
        ],
        'parent_material' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Parent material',
            'options' => 'parent_materials',
            'placeholder' => 'S235JR',
            'filter' => 'select'
        ],
        'stitch_type' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Stitch type',
            'options' => [
                'Tværgående stumpsømme med delvis indtrængning i stumpsamlinger' => 'Tværgående stumpsømme med delvis indtrængning i stumpsamlinger',
                'Tværgående stumpsømme med delvis indtrængning i krydssamlinger' => 'Tværgående stumpsømme med delvis indtrængning i krydssamlinger',
                'Tværgående stumpsømme med delvis indtrængning i T-samlinger' => 'Tværgående stumpsømme med delvis indtrængning i T-samlinger',
                'Tværkansømme med a > 12 mm eller t > 30 mm' => 'Tværkansømme med a > 12 mm eller t > 30 mm',
                'Tværkansømme med a ≤ 12 mm og t ≤ 30 mm' => 'Tværkansømme med a ≤ 12 mm og t ≤ 30 mm',
                'Langsgående svejsesømme med fuld gennemsvejsning mellem krop og overflange af en krandrager' => 'Langsgående svejsesømme med fuld gennemsvejsning mellem krop og overflange af en krandrager',
                'Andre langsgående sømme, svejsninger på afstivninger og sømme specificeret i udførselsspecifikation som værende trykpåvirket' => 'Andre langsgående sømme, svejsninger på afstivninger og sømme specificeret i udførselsspecifikation som værende trykpåvirket (Langsgående sømme er sømme udført parallelt med komponent akse. Alle andre sømme anses for at være tværgående sømme)',
            ],
            'filter' => 'select',
            'filter_options' => [
                'min_options_for_radio' => 1
            ]
        ],
        'welder_id' => [
            'type' => 'relationship',
            'relationship' => 'welder',
            'class' => Welder::class,
            'label' => 'Welder',
            'placeholder' => 'Choose Welder',
            'filter' => 'relationship'
        ],
        'welding_equipment' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Welding equipment',
            'options' => 'routine_inspection_welding_equipment',
            'placeholder' => '',
            'filter' => 'select'
        ],
    ];

    public function wps(): BelongsTo
    {
        return $this->belongsTo(Wps::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function welder(): BelongsTo
    {
        return $this->belongsTo(Welder::class);
    }

    public static function wpss()
    {
        return Wps::join('routine_inspections', 'wps.id', '=', 'routine_inspections.wps_id')
            ->select([
                'wps.id',
                'wps.data',
                DB::raw('SUM(routine_inspections.data->>"$.weld_length") as total_length'),
                DB::raw('SUM(routine_inspections.data->>"$.inspected_length") as inspected_length')
            ])
            ->groupBy('wps.id');
    }

    public static function welders()
    {
        return Welder::join('routine_inspections', 'welders.id', '=', 'routine_inspections.welder_id')
            ->select([
                'welders.id',
                'welders.data',
                DB::raw("MAX(JSON_UNQUOTE(JSON_EXTRACT(routine_inspections.data, '$.date'))) AS latest_inspect_date")
            ])
            ->groupBy('welders.id');
    }

    public static function weldingEquipment()
    {
        return DB::table(DB::raw("routine_inspections, JSON_TABLE(routine_inspections.data, '$.welding_equipment[*]' COLUMNS (value VARCHAR(255) PATH '$')) AS equipment"))
            ->select([
                DB::raw('equipment.value AS id'),
                DB::raw("MAX(JSON_UNQUOTE(JSON_EXTRACT(routine_inspections.data, '$.date'))) AS latest_inspect_date")
            ])
            ->groupBy('equipment.value')
            ->orderBy('equipment.value');
    }
}
