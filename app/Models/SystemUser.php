<?php

namespace App\Models;


class SystemUser extends User
{
    public static function get_choices()
    {
        return User::query()
                ->where('role', self::PARTNER_ROLE)
                ->orWhere('role', self::ADMIN_ROLE)
                ->get()
                ->pluck('name', 'id')
                ->toArray();
        }
}
