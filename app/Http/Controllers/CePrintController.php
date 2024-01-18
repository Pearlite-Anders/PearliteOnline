<?php

namespace App\Http\Controllers;

use App\Models\Ce;
use Illuminate\Http\Request;
use function Spatie\LaravelPdf\Support\pdf;


class CePrintController extends Controller
{
    public function __invoke(Request $request, Ce $ce)
    {
        return pdf()
                ->view('livewire.ce.pdf', [
                    'ce' => $ce,
                ])
                ->name('ce-' . $ce->id . '.pdf');
    }
}
