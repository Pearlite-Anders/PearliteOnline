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
            ]
        ];
    }
}
