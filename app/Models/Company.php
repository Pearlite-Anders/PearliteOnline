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

    public function welding_certificates()
    {
        return $this->hasMany(WeldingCertificate::class);
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
