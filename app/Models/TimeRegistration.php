<?php

namespace App\Models;

use App\Data\CompanyData;
use App\Data\InternalOrderData;
use App\Data\ProjectData;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeRegistration extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public const LABEL_KEY = ['data.name'];

    public const SYSTEM_COLUMNS = [
        'user_id' => [
            'type' => 'relationship',
            'relationship' => 'user',
            'class' => SystemUser::class,
            'label' => 'User',
            'placeholder' => 'Choose user',
            'filter' => 'relationship',
            'create_popup' => false,
            'multiple' => false,
            'restrictions' => [
                'view' => [User::ADMIN_ROLE],
                'edit' => [User::ADMIN_ROLE],
            ]
        ],
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
        'internal_order_id' => [
            'type' => 'dynamic_relationship',
            'relationship' => 'company_id',
            'class' => InternalOrder::class,
            'label' => 'Order',
            'placeholder' => 'Choose order',
            'filter' => 'relationship',
            'create_popup' => true,
            'data_class' => InternalOrderData::class,
            'multiple' => false,
        ],
        'date' => [
            'type' => 'date',
            'label' => 'Date',
            'required' => true,
            'placeholder' => '',
            'filter' => 'date'
        ],

        'start' => [
            'type' => 'time',
            'label' => 'Start time',
            'required' => true
        ],
        'end' => [
            'type' => 'time',
            'label' => 'End time',
            'required' => true
        ],
        'hours' => [
            'type' => 'system_text',
            'label' => 'Timer',
            'default' => 0,
            'sum' => true
        ],
        'driving' => [
            'type' => 'number',
            'label' => 'Kørsel',
            'required' => false,
            'placeholder' => '',
            'filter' => 'search',
            'postfix' => 'km',
            'sum' => true
        ],
        'expenses' => [
            'type' => 'number',
            'label' => 'Udgifter',
            'required' => false,
            'placeholder' => '',
            'filter' => 'search',
            'postfix' => 'DKK',
            'info' => 'f.eks. storebæltsbro eller overnatning',
            'sum' => true
        ],
        'paid' => [
            'type' => 'checkbox',
            'label' => 'Billable',
            'required' => false,
            'placeholder' => '',
            'filter' => 'search'
        ],
        'invoiced' => [
            'type' => 'checkbox',
            'label' => 'Invoiced',
            'required' => false,
            'placeholder' => '',
            'filter' => 'search'
        ],
        'remarks' => [
            'type' => 'textarea',
            'label' => 'Remarks',
            'required' => false,
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function internalorder()
    {
        return $this->belongsTo(InternalOrder::class, 'internal_order_id');
    }
}
