<?php

namespace App\Livewire\DataTable;

trait WithDelete {

    public $confirming;

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function cancelConfirmDelete()
    {
        $this->confirming = null;
    }

    public function delete($id)
    {
        $model = $this->model::findOrFail($id);
        $this->authorize('delete', $model);

        $model->delete();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Deleted successfully.')
        );
    }
}
