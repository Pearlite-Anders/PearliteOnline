<?php

namespace App\Livewire\Document;

use Livewire\Component;
use App\Models\Document;


class Show extends Component
{
    public Document $document;
    public bool $confirming = false;

    public function mount(Document $document)
    {
        abort_unless(auth()->user()->can('view', $document), 403);
        $this->$document = $document;
    }

    public function render()
    {
        return view('livewire.document.show');
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
