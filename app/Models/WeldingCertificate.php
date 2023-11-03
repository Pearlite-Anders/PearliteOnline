<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Kolossal\Multiplex\HasMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeldingCertificate extends Model
{
    use HasFactory, HasMeta, SoftDeletes;

    protected $guarded = [];

    protected array $metaKeys = [
        '*',
        'date_examination' => 'date',
    ];

    protected $casts = [
        'previous_files' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getDateExpirationAttribute()
    {
        $date_examination = clone $this->date_examination;
        return $date_examination ? $date_examination->addYears(3)->format('Y.m.d') : null;
    }

}
