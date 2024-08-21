<?php

namespace App\Livewire\Document;

use Livewire\Component;
use App\Models\Document;


class Show extends Component
{
    public Document $document;

    public function mount(Document $document)
    {
        $this->$document = $document;
    }

    public function render()
    {
        return view('livewire.document.show');
    }
}
