<?php

namespace App\Models;

use App\Models\Trait\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, HasFilter, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public const SYSTEM_COLUMNS = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'required' => true,
            'placeholder' => '',
            'filter' => 'search'
        ],
        'road' => [
            'type' => 'text',
            'label' => 'Road',
            'required' => true,
            'placeholder' => '',
            'filter' => 'search'
        ],
        'phone' => [
            'type' => 'text',
            'label' => 'Phone',
            'required' => true,
            'placeholder' => '',
            'filter' => 'search'
        ],
        'email' => [
            'type' => 'text',
            'label' => 'Email',
            'required' => true,
            'placeholder' => '',
            'filter' => 'search'
        ],
        'invoice_email' => [
            'type' => 'text',
            'label' => 'Invoice email',
            'required' => true,
            'placeholder' => '',
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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function weldingcertificates()
    {
        return $this->hasMany(WeldingCertificate::class);
    }

    public function wpqrs()
    {
        return $this->hasMany(Wpqr::class);
    }

    public function wps()
    {
        return $this->hasMany(Wps::class);
    }

    public function welders()
    {
        return $this->hasMany(Welder::class);
    }

    public function modules()
    {
        return [
            'users' => (object)[
                'name' => __('Users'),
                'class' => \App\Modal\User::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
            'welding-certificates' => (object)[
                'name' => __('Welding Certificates'),
                'class' => \App\Modal\WeldingCertificates::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
            'wpqr' => (object)[
                'name' => __('WPQR'),
                'class' => \App\Modal\Wpqr::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
            'wps' => (object)[
                'name' => __('WPS'),
                'class' => \App\Modal\Wps::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
            'welder' => (object)[
                'name' => __('Welders'),
                'class' => \App\Livewire\Welder::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
            'settings' => (object)[
                'name' => __('Settings'),
                'class' => \App\Livewire\Settings::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
        ];
    }
}
