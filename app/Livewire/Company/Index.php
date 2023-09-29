<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        if(!(auth()->user()->isPartner() || auth()->user()->isAdmin())) {
            abort(403);
        }

        return view('livewire.company.index')->with([
            'companies' => Auth()->user()->companies,
        ]);
    }
}
