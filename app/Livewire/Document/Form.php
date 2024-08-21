<?php

namespace App\Livewire\Document;

use App\Models\File;
use App\Models\Document;
use App\Data\DocumentData;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;

    public function setFields(Document $document)
    {
        $this->data = DocumentData::from($document->data);
    }

    public function create()
    {
        $document = Document::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        return $weldingCoordination;
    }

    public function update(Document $document)
    {
        $document->update($this->transformedData());

        // return $this->handleUploads($weldingCoordination);
    }

    public function transformedData()
    {
        $data = array_merge([
        ], $this->except([
            'files',
            'current_files',
        ]));

        return $data;
    }
}
