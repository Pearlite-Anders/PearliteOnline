<?php

namespace App\Models;

use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactPerson extends Model
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
            'placeholder' => 'Hans Hansen',
            'filter' => 'search'
        ],
        'email' => [
            'type' => 'text',
            'label' => 'Email',
            'required' => true,
            'placeholder' => 'HH@smed.dk',
            'filter' => 'search'
        ],
        'phone' => [
            'type' => 'text',
            'label' => 'Phone',
            'required' => true,
            'placeholder' => '987654321',
            'filter' => 'search'
        ],
        'position' => [
            'type' => 'text',
            'label' => 'Position',
            'required' => true,
            'placeholder' => 'Smedemester',
            'filter' => 'search'
        ],
        'remarks' => [
            'type' => 'textarea',
            'label' => 'Remarks',
            'required' => true,
            'placeholder' => '',
            'filter' => 'search'
        ],
    ];

    public function loadAll()
    {
        return $this;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
