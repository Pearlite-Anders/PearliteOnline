<?php

namespace App\Livewire\Document;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Document;
use App\Models\DocumentRevision;


class Show extends Component
{
    public Document $document;
    #[Url(as: 'revision')]
    public ?string $revisionId;
    public bool $confirming = false;

    public function mount(Document $document)
    {
        abort_unless(auth()->user()->can('view', $document), 403);
        $this->document = $document;
        $this->revisionId = $this->revisionId ?? null;
    }

    public function render()
    {
        $revision = $this->revisionId ? $this->document->revisions()->findOrFail($this->revisionId) : $this->document->currentRevision;
        $showActions = $this->revisionId ? false : true;
        return view('livewire.document.show', ['revision' => $revision, 'showActions' => $showActions]);
    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function cancelConfirmDelete()
    {
        $this->confirming = false;
    }

    public function delete()
    {
        $this->document->delete();
        return redirect()->route('documents.index');
    }
}
