<?php

namespace App\Livewire\Document;

use App\Models\File;
use App\Models\Document;
use App\Data\DocumentData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $data;
    public array $files = [];
    public Collection $current_files;
    public array $permissions;

    public function setFields(Document $document)
    {
        $this->data = DocumentData::from($document->data);
        $this->current_files = collect($document->files)->map(function($file) {
            return File::find($file);
        });
    }

    public function create()
    {
        $user = auth()->user();
        $data = $this->transformedData();
        $permissions = collect($this->permissions)->mapWithKeys(function (array $item, int $key) {
            return [$key => [
                'view' => $item['view'],
                'edit' => $item['edit'],
            ]];
        });

        $document = DB::transaction(function () use ($user, $data, $permissions) {
            $document = Document::create(array_merge([
                'company_id' => $user->currentCompany->id,
                'owner_id' => $user->id,
            ], $data));

            $document->users()->sync($permissions);

            return $document;
        });

        return $document;
    }

    public function update(Document $document)
    {
        $data = $this->transformedData();
        $permissions = collect($this->permissions)->mapWithKeys(function (array $item, int $key) {
            return [$key => [
                'view' => $item['view'],
                'edit' => $item['edit'],
            ]];
        });

        $document = DB::transaction(function () use ($document, $data, $permissions) {
            $document->update($data);
            $document->users()->sync($permissions);

            return $document;
        });

        return $this->handleUploads($document);
    }

    public function transformedData()
    {
        $data = array_merge([
        ], $this->except([
            'files',
            'current_files',
            'permissions'
        ]));

        return $data;
    }

    public function togglePermission($user_index, $permission)
    {
        $this->permissions[$user_index][$permission] = !$this->permissions[$user_index][$permission];
    }

    public function toggleAllViewPermission()
    {
        $this->data->default_view = !$this->data->default_view;
    }

    public function toggleAllEditPermission()
    {
        $this->data->default_edit = !$this->data->default_edit;
        if ($this->data->default_edit) {
            $this->data->default_view = true;
        }
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
