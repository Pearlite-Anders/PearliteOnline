<?php

namespace App\Livewire\Company;

use Livewire\Attributes\Rule;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    #[Rule('required|min:2')]
    public $name = '';
}
