<?php

namespace App\Livewire\Backoffice\InternalOrder;

use App\Models\File;
use App\Models\InternalOrder;
use App\Data\InternalOrderData;
use App\Models\InternalOrderReport;
use Illuminate\Support\Carbon;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public InternalOrder $internalOrder;

    public $data;
    public $company_id;

    public function setFields(InternalOrder $internalOrder)
    {
        $this->internalOrder = $internalOrder;
        $this->data = InternalOrderData::from($internalOrder->data);
        $this->company_id = $internalOrder->company_id;

    }

    public function create()
    {
        $internalOrder = InternalOrder::create(array_merge([
        ], $this->transformedData()));

        $internalOrder = $this->handleUploads($internalOrder);

        return $internalOrder;
    }

    public function update()
    {
        $this->internalOrder->update($this->transformedData());

        return $this->handleUploads($this->internalOrder);
    }

    public function transformedData()
    {
        $data = array_merge([
        ], $this->except([
            'internalOrder',
        ]));

        return $data;
    }

    public function handleUploads($internalOrder)
    {
        return $internalOrder;
    }
}
