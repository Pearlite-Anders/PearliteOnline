<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

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

    public function modules()
    {
        return [
            'users' => (object)[
                'name' => __('Users'),
                'class' => \App\Livewire\User\Index::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
            'welding-certificates' => (object)[
                'name' => __('Welding Certificates'),
                'class' => \App\Livewire\WeldingCertificates\Index::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
            'wpqr' => (object)[
                'name' => __('WPQR'),
                'class' => \App\Livewire\Wpqr\Index::class,
                'permissions' => [
                    'view' => __('View'),
                    'edit' => __('Edit'),
                ]
            ],
            'wps' => (object)[
                'name' => __('WPS'),
                'class' => \App\Livewire\Wps\Index::class,
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
