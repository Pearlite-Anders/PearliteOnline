<?php

namespace App\Models\Trait;

use App\Models\Company;
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
        $collection = auth()->user()->currentCompany->{$plural_modal};
        if(is_array(self::LABEL_KEY)) {
            return $collection->mapWithKeys(function($item) {
                $array = array_map(function($key) use ($item) {
                    if(preg_match('/^data\./', $key)) {
                        return optional($item->data)[Str::replace('data.', '', $key)];
                    }
                    return $item->{$key};
                }, self::LABEL_KEY);

                return [$item->id => implode(' - ', $array)];
            })->toArray();
        }
        return $collection->pluck(self::LABEL_KEY, 'id')->toArray();
    }
}
