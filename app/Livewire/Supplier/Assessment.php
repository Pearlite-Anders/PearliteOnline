<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;
use App\Models\Supplier;
use App\Models\SupplierReport;
use Illuminate\Support\Carbon;

class Assessment extends Component
{
    use WithFileUploads;
    public Supplier $supplier;
    public $class;
    public $buttonText;

    public bool $assessmentFormOpen = false;

    public $assessment_date;
    public $assessment_file;

    public function mount(Supplier $supplier, $class = null, $buttonText = null)
    {
        if ($buttonText == null) {
            $buttonText = __('New assessment');
        }
        $this->authorize('update', $supplier);
        $this->supplier = $supplier;
        $this->class = $class;
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('livewire.supplier.assessment');
    }

    public function toggleAssessmentFormOpen(): void
    {
        $this->assessmentFormOpen = !$this->assessmentFormOpen;
    }

    public function createAssessment()
    {
        $report = new SupplierReport();
        $report->supplier_id = $this->supplier->id;
        $report->user_id = auth()->user()->id;
        $report->data = [
            'assessment_date' => $this->assessment_date,
        ];
        $report->save();

        if($this->assessment_file) {
            $file = File::fromTemporaryUpload($this->assessment_file, $report, $report->supplier->company_id);
            $report->current_file_id = $file->id;
            $report->save();
        }

        // Update the supplier's latest assessment date to keep easier to figure out when the next assement is due.
        $supplierData = $this->supplier->data;
        $supplierData["latest_assessment_date"] = $this->assessment_date;
        $this->supplier->data = $supplierData;
        $this->supplier->save();

        $this->assessmentFormOpen = false;
        $this->dispatch("assessment-created");
    }
}
