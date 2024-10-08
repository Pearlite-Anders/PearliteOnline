<?php

namespace App\Livewire\Supplier;

use App\Livewire\DataTable\WithColumns;
use App\Models\Supplier;
use Livewire\Component;


class Index extends Component
{
    use WithColumns;

    public $model = Supplier::class;
    public $company;

    public function mount()
    {
        $this->company = \Auth::user()->currentCompany;
    }

    public function render()
    {
        $this->authorize('viewAny', Supplier::class);

        return view('livewire.supplier.index');
    }
}
