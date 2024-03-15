<?php

namespace App\Livewire\MachineMaintenance;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\MachineMaintenance;

class Edit extends Component
{
    use Shared, WithFileUploads;
    public Form $form;
    public MachineMaintenance $machineMaintenance;

    public function update()
    {
        $this->form->update($this->machineMaintenance);

        return redirect()
                ->route('machine-maintenance.index')
                ->with('flash.banner', __('MachineMaintenance updated.'));
    }

    public function mount(MachineMaintenance $machineMaintenance)
    {
        $this->welder = $machineMaintenance;
        $this->form->setFields($machineMaintenance);
    }

    public function render()
    {
        return view('livewire.machine-maintenance.edit');
    }
}
