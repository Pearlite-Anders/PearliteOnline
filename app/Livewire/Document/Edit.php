<?php

namespace App\Livewire\Document;

use Livewire\Component;

use App\Livewire\WithTrixUploads;
use App\Models\Document;

class Edit extends Component
{
    use WithTrixUploads;

    public Form $form;
    public Document $document;

    public function render()
    {
        return view('livewire.document.edit');
    }

    public function update()
    {
        $this->form->update($this->document);

        return redirect()
                ->route('documents.show', ['document' => $this->document->id])
                ->with('flash.banner', __('Document updated.'));
    }

    public function mount(Document $document)
    {
        $this->$document = $document;
        $this->form->setFields($document);
    }
}
