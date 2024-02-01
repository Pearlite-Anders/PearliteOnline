<?php

namespace App\Policies;

use App\Models\Formula;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPolicy extends BasePolicy
{
    public $type = 'supplier';
}
