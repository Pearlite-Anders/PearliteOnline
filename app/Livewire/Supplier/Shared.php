<?php

namespace App\Livewire\Supplier;

use Livewire\Attributes\Computed;
use App\Livewire\DataTable\WithDelete;

trait Shared
{
    use WithDelete;

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


    public function delete($id)
    {
        $model = $this->supplier?->documents()->findOrFail($id);

        $model->file?->delete();
        $model->delete();

        return redirect()->route('supplier.edit', $this->form->supplier_id)->with('flash.banner', __('Deleted successfully.'));
    }

    public function toggleStatus($id)
    {
        $this->form->toggleStatus($id);

        return redirect()->route('supplier.edit', $this->form->supplier_id)->with('flash.banner', __('Status updated.'));
    }
}
