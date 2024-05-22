<?php

namespace App\Policies;

use App\Models\Formula;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MachineMaintenancePolicy extends BasePolicy
{
    public $type = 'machine-maintenance';
}
