<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WeldingCertificate;
use Illuminate\Auth\Access\Response;

class WpqrPolicy extends BasePolicy
{
    public $type = 'wpqr';
}
