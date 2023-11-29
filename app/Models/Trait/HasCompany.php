<?php

namespace App\Models\Trait;

trait HasCompany
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
