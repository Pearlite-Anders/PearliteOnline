<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeldingCoordination;
use function Spatie\LaravelPdf\Support\pdf;

class WeldingCoordinationPrintController extends Controller
{
    public function __invoke(Request $request, WeldingCoordination $weldingCoordination)
    {
        // return view('livewire.welding-coordination.pdf', [
        //     'weldingCoordination' => $weldingCoordination,
        // ]);

        return pdf()
                ->view('livewire.welding-coordination.pdf', [
                    'weldingCoordination' => $weldingCoordination,
                ])
                ->margins(10, 10, 10, 10)
                ->name('welding-coordination-' . $weldingCoordination->id . '.pdf');
    }
}
