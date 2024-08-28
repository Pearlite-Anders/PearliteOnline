<?php

namespace App\Livewire\Document;

use App\Models\File;
use App\Models\Document;
use App\Data\DocumentData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;
    public array $files = [];
    public Collection $current_files;

    public function setFields(Document $document)
    {
        $this->data = DocumentData::from($document->data);
        $this->current_files = collect($document->files)->map(function($file) {
            return File::find($file);
        });
    }

    public function create()
    {
        $document = Document::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
            'owner_id' => auth()->user()->id,
        ], $this->transformedData()));

        return $document;
    }

    public function update(Document $document)
    {
        $document->update($this->transformedData());

        return $this->handleUploads($document);
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

    public function handleUploads($model)
    {
        $current_files = [];
        if($this->current_files) {
            foreach ($this->current_files as $file) {
                $current_files[] = $file->id;
            }
        }

        if($this->files) {
            foreach ($this->files as $file) {
                $current_files[] = File::fromTemporaryUpload($file, $model)->id;
            }
        }

        $model->files = $current_files;
        $model->save();

        return $model;
    }
}
