<?php

namespace Database\Scripts;

use App\Models\Supplier;

class FixLatestAssesmentDateToSuppliers
{
    public static function handle()
    {
        $suppliers = Supplier::all();

        foreach ($suppliers as $supplier) {
            if(!$supplier->reports->count()) {
                continue;
            }
            $latestReport = $supplier->reports->last();
            $data = $supplier->data;
            $data["latest_assessment_date"] = $latestReport->data["assessment_date"];
            $supplier->data = $data;
            $supplier->save();
        }
    }
}
