<?php

namespace App\Models;

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
            'filter' => 'radios'
        ],
    ];

    public function loadAll()
    {
        return $this;
    }
}
