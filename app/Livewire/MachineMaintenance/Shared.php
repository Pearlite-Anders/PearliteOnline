<?php

namespace App\Livewire\MachineMaintenance;

use App\Models\MachineMaintenance;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{
    public $confirmingFile = null;

    public function confirmDeleteFile($id)
    {
        $this->confirmingFile = $id;
    }

    public function cancelConfirmDeleteFile()
    {
        $this->confirmingFile = null;
    }

    public function deleteFile($id)
    {
        $this->form->deleteFile($id);

        $this->confirmingFile = null;
        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Deleted successfully.')
        );
    }
}
