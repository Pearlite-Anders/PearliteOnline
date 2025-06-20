<?php

namespace App\Policies;

use App\Models\InternalOrder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InternalOrderPolicy extends BasePolicy
{
    public $type = 'internal-order';
}
