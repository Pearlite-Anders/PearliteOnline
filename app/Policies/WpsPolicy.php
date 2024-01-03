<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WeldingCertificate;
use Illuminate\Auth\Access\Response;

class WpsPolicy extends BasePolicy
{
    public $type = 'wps';
}
