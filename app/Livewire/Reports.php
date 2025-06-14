<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Reports extends Component
{
    #[Reactive]
    public $reports;
    public $allowDelete = false;
    public $dateField = '';

    public $confirmingDeleteReport = null;

    public function deleteReport($id)
    {
        $this->dispatch('delete-report', id: $id);
        $this->confirmingDeleteReport = null;
    }

    public function cancelConfirmDeleteReport()
    {
        $this->confirmingDeleteReport = null;
    }

    public function confirmDeleteReport($id)
    {
        $this->confirmingDeleteReport = $id;
    }

    public function render()
    {
        return view('livewire.reports');
    }
}
