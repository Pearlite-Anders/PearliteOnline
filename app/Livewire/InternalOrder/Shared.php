<?php

namespace App\Livewire\InternalOrder;

use Livewire\Attributes\Computed;

trait Shared
{
    #[Computed]
    public function next_assessment()
    {
        return $this->supplier->next_assessment;
    }

    public function createReport()
    {
        $this->form->createReport();

        return redirect()->route('internal-order.edit', $this->form->supplier_id)->with('flash.banner', __('Assesment created.'));
    }
}
