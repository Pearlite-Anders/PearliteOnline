<?php

if (!function_exists('setting')) {
    function setting($key, $default = null, $company_id = null)
    {
        return \App\Models\Setting::get($key, $default, $company_id);
    }
}
