<?php

namespace App\Livewire\WeldingCoordination;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Optional;

trait Shared
{
    #[Computed]
    public function next_assessment()
    {
        return $this->welding_coordination->next_assessment;
    }

    public function createReport()
    {
        $this->form->createReport();

        return redirect()->route('welding-coordination.edit', $this->form->welding_coordination_id)->with('flash.banner', __('Assesment created.'));
    }
}
