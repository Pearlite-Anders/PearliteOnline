<?php

namespace App\Livewire\Supplier;

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

        return redirect()->route('supplier.edit', $this->form->supplier_id)->with('flash.banner', __('Assesment created.'));
    }
}
