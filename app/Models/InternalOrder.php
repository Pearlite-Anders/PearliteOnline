<?php

namespace App\Models;

use App\Data\CompanyData;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InternalOrder extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'images' => 'array',
        'files' => 'array',
    ];

    public const LABEL_KEY = 'data.name';

    public const SYSTEM_COLUMNS = [
        'company_id' => [
            'type' => 'relationship',
            'relationship' => 'company',
            'class' => Company::class,
            'label' => 'Company',
            'placeholder' => 'Choose company',
            'filter' => 'relationship',
            'create_popup' => false,
            'data_class' => CompanyData::class,
            'multiple' => false,
        ],
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'required' => true,
            'filter' => 'search'
        ],
        'number' => [
            'type' => 'text',
            'label' => 'Number',
            'required' => true,
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
    ];

    public function loadAll()
    {
        return $this;
    }
}
