<?php

namespace App\Livewire\DocumentRevision;

use Livewire\Component;
use App\Models\Document;
use App\Models\DocumentRevision;
use App\Livewire\DataTable\WithTable;
use App\Livewire\DataTable\WithColumns;
use App\Livewire\DataTable\WithDelete;
use App\Livewire\DataTable\WithPerPagePagination;

class Index extends Component
{
    use WithTable, WithPerPagePagination, WithColumns, WithDelete;

    public $model = DocumentRevision::class;
    public Document $document;
    public $confirmingRestore = null;

    public function mount(Document $document)
    {
        abort_unless(auth()->user()->can('view', $document), 403);
        $this->document = $document;
    }

    public function getRowsQueryProperty()
    {
        return $this->document->revisions()->latest();
    }

    public function render()
    {
        $this->authorize('view', $this->model);

        return view('livewire.document-revision.index')->with([
            'revisions' => $this->rows
        ]);
    }

    public function confirmRestore($id)
    {
        $this->confirmingRestore = $id;
    }

    public function cancelConfirmRestore()
    {
        $this->confirmingRestore = null;
    }

    public function restore($id)
    {
        $model = $this->document->revisions()->findOrFail($id);
        $this->authorize('update', $model);

        $revision = $this->document->revisions()->create(['data' => $model->data]);
        $this->document->removeOldRevision();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Restored successfully.')
        );
        $this->cancelConfirmRestore();
    }
}
