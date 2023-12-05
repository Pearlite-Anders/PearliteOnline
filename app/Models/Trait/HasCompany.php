<?php

namespace App\Models\Trait;

use Illuminate\Support\Str;

trait HasCompany
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function get_choices()
    {
        $plural_modal = Str::plural(Str::lower(Str::replace('App\Models\\', '', self::class)));
        return auth()->user()->currentCompany->{$plural_modal}->pluck(self::LABEL_KEY, 'id')->toArray();
    }
}
