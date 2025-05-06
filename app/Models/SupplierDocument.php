<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public const SYSTEM_COLUMNS = [
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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
