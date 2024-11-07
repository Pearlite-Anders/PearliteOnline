<?php

namespace App\Livewire\WeldingCoordination;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Livewire\WithTrixUploads;
use App\Models\WeldingCoordination;

class Edit extends Component
{
    use Shared, WithFileUploads, WithTrixUploads;
    public Form $form;
    public WeldingCoordination $weldingCoordination;

    public function update()
    {
        $this->form->update($this->weldingCoordination);

        return redirect()
                ->route('welding-coordination.index')
                ->with('flash.banner', __('WeldingCoordination updated.'));
    }

    public function mount(WeldingCoordination $weldingCoordination)
    {
        $this->authorize('update', $weldingCoordination);
        $this->welding_coordination = $weldingCoordination;
        $this->form->setFields($weldingCoordination);
    }

    public function render()
    {
        return view('livewire.welding-coordination.edit');
    }
}
