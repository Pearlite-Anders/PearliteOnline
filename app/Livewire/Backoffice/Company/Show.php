<?php

namespace App\Livewire\Backoffice\Company;

use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Show extends Component
{
    public Company $company;

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function render()
    {
        if(!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('livewire.backoffice.company.show');
    }
}
