<?php

namespace App\Livewire\User;

use Livewire\Attributes\Rule;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    #[Rule('required|min:2')]
    public $name = '';

    #[Rule('required|email')]
    public $email = '';

    #[Rule('min:4')]
    public $password = '';

    #[Rule('required')]
    public $role = '';

    public $permissions = [];
}
