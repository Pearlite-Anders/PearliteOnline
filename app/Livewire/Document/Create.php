<?php

namespace App\Livewire\Document;

use App\Data\DocumentData;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\WithTrixUploads;

class Create extends Component
{
    use WithFileUploads, WithTrixUploads;

    public Form $form;

    public function create()
    {
        $document = $this->form->create();

        return redirect()->route('documents.show', ['document' => $document->id])
            ->with('flash.banner', __('Document created.'));
    }

    public function mount()
    {
        $this->form->data = DocumentData::from(['title' => '']);
    }

    public function render()
    {
        return view('livewire.document.create');
    }
}
