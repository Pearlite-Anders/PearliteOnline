<?php

namespace App\Livewire\Document;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Document;
use App\Models\DocumentRevision;

class Show extends Component
{
    public Document $document;
    public $rootDocument;
    #[Url(as: 'revision')]
    public ?string $revisionId = null;
    public bool $confirming = false;

    public function mount(Document $document)
    {
        abort_unless(auth()->user()->can('view', $document), 403);
        $this->document = $document;
        $this->revisionId = $this->revisionId ?? null;

        $this->rootDocument = $this->document->isRoot() ? $this->document : $this->document->ancestors()->first();
        // dd(auth()->user()->currentCompany->id);
    }

    public function render()
    {
        $revision = $this->revisionId ? $this->document->revisions()->findOrFail($this->revisionId) : $this->document->currentRevision;
        $showActions = $this->revisionId ? false : true;
        $treeRoot = Document::scoped(['company_id' => auth()->user()->currentCompany->id])->with('currentRevision')->descendantsAndSelf($this->rootDocument->id)->toTree()->first();
        return view(
            'livewire.document.show',
            [
                'revision' => $revision,
                'showActions' => $showActions,
                'treeRoot' => $treeRoot,
            ]
        );
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
