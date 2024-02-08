<?php

namespace App\Policies;

use App\Models\Formula;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class WeldingCoordinationPolicy extends BasePolicy
{
    public $type = 'welding_coordination';
}
