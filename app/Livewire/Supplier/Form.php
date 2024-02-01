<?php

namespace App\Livewire\Supplier;

use App\Models\File;
use App\Models\Supplier;
use App\Data\SupplierData;
use App\Models\SupplierReport;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public $new_file;
    public $current_file;
    public $supplier_id;
    public $data;
    public $responsible_user_id;
    public $new_assessment_date;
    public $new_assessment_file;

    public function setFields(Supplier $supplier)
    {
        $this->data = SupplierData::from($supplier->data);

        if($supplier->current_file_id) {
            $this->current_file = File::find($supplier->current_file_id);
        }

        $this->responsible_user_id = $supplier->responsible_user_id;
        $this->supplier_id = $supplier->id;
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
            'new_file',
            'current_file',
            'supplier_id',
            'new_assessment_date',
            'new_assessment_file',
        ]));

        return $data;
    }

    public function handleUploads(Supplier $supplier)
    {
        if($this->new_file) {
            if($supplier->current_file_id) {
                $file = File::find($supplier->current_file_id);
                $file->delete();
            }

            $file = File::fromTemporaryUpload($this->new_file, $supplier);
            $supplier->current_file_id = $file->id;
            $supplier->save();
        }

        return $supplier;
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

        return $report;
    }

}
