<?php

namespace App\Models;

use App\Data\ProjectData;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeldingCoordination extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'files' => 'array',
    ];

    public const LABEL_KEY = ['data.name'];

    public const SYSTEM_COLUMNS = [
        'purpose' => [
            'type' => 'text',
            'label' => 'Purpose',
            'required' => true,
            'placeholder' => 'Svejsekoordination af ordre',
            'filter' => 'search'
        ],
        'date' => [
            'type' => 'date',
            'label' => 'Date',
            'required' => true,
            'placeholder' => '2021-01-01',
            'filter' => 'date'
        ],
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
        'activity' => [
            'type' => 'rich_text',
            'label' => 'Activity',
            'required' => true,
            'placeholder' => 'Write welding coordination',
            'filter' => 'search'
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
