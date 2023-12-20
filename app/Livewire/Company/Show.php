<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

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

        return view('livewire.company.show');
    }
}
