<?php

namespace App\Policies;

use App\Models\Formula;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FormulaPolicy extends BasePolicy
{
    public $type = 'formula';
}
