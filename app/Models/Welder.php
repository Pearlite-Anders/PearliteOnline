<?php

namespace App\Models;

use App\Data\ProjectData;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Welder extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public const LABEL_KEY = 'data.name';

    public const SYSTEM_COLUMNS = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'required' => true,
            'placeholder' => 'Anders Andersen',
            'filter' => 'search'
        ],
        'welder_id' => [
            'type' => 'text',
            'label' => 'Welder ID',
            'required' => false,
            'placeholder' => '123',
            'filter' => 'search'
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
        'position' => [
            'type' => 'radios',
            'multiple' => false,
            'label' => 'Internal/External',
            'options' => [
                'internal' => 'Internal',
                'external' => 'External',
            ],
            'filter' => 'radios'
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
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function loadAll()
    {
        return $this;
    }
}
