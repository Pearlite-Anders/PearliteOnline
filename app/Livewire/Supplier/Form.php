<?php

namespace App\Livewire\Supplier;

use App\Models\File;
use App\Models\Supplier;
use App\Data\SupplierData;
use App\Data\SupplierDocumentData;
use App\Models\SupplierReport;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $supplier_id;
    public $data;
    public $responsible_user_id;
    public $new_assessment_date;
    public $new_assessment_file;
    public $files = [];
    public $documents;

    public function setFields(Supplier $supplier)
    {
        $this->data = SupplierData::from($supplier->data);

        $this->responsible_user_id = $supplier->responsible_user_id;
        $this->supplier_id = $supplier->id;

        $this->documents = $supplier->documents()->with('file')->get();
    }

    public function create()
    {
        $supplier = Supplier::create(array_merge([
            'company_id' => auth()->user()->currentCompany->id,
        ], $this->transformedData()));

        $supplier = $this->handleUploads($supplier);

        return $supplier;
    }

    public function update($supplier)
    {
        $supplier->update($this->transformedData());

        return $this->handleUploads($supplier);
    }

    public function transformedData()
    {
        $data = array_merge([
        ], $this->except([
            'supplier_id',
            'new_assessment_date',
            'new_assessment_file',
            'files',
            'documents',
        ]));

        return $data;
    }

    public function handleUploads($model)
    {
        if($this->files) {
            foreach ($this->files as $file) {
                $document = $model->documents()->create(['data' => SupplierDocumentData::from(['status' => 'active'])]);
                $fileModel = File::fromTemporaryUpload($file, $document, $model->company_id);
            }
        }

        return $model;
    }

    public function createReport()
    {
        $report = new SupplierReport();
        $report->supplier_id = $this->supplier_id;
        $report->user_id = auth()->user()->id;
        $report->data = [
            'assessment_date' => $this->new_assessment_date,
        ];
        $report->save();

        if($this->new_assessment_file) {
            $file = File::fromTemporaryUpload($this->new_assessment_file, $report, $report->supplier->company_id);
            $report->current_file_id = $file->id;
            $report->save();
        }

        // Update the supplier's latest assessment date to keep easier to figure out when the next assement is due.
        $supplier = Supplier::find($this->supplier_id);
        $supplierData = $supplier->data;
        $supplierData["latest_assessment_date"] = $this->new_assessment_date;
        $supplier->data = $supplierData;
        $supplier->save();

        return $report;
    }

    public function toggleStatus($id)
    {
        $supplier = Supplier::findOrFail($this->supplier_id);
        $model = $supplier->documents()->findOrFail($id);

        $data = $model->data;
        if (isset($data['status'])) {
            $data['status'] = ($data['status'] == 'active') ? 'inactive' : 'active';
        } else {
            $data['status'] = 'inactive';
        }

        $model->data = $data;
        $model->save();

        return $model;
    }

}
