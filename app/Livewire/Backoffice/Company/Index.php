<?php

namespace App\Livewire\Backoffice\Company;

use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.backoffice')]
class Index extends Component
{
    public function render()
    {
        if(!(auth()->user()->isPartner() || auth()->user()->isAdmin())) {
            abort(403);
        }

        return view('livewire.backoffice.company.index')->with([
            'companies' => Auth()->user()->companies,
        ]);
    }
}
