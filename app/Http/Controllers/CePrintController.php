<?php

namespace App\Http\Controllers;

use App\Models\Ce;
use Illuminate\Http\Request;
use function Spatie\LaravelPdf\Support\pdf;
use Spatie\Browsershot\Browsershot;

class CePrintController extends Controller
{
    public function __invoke(Request $request, Ce $ce)
    {
        $signature = null;

        if ($ce->data['signature']) {
            $setting = $row = setting('signature_group')[$ce->data['signature']];
            $signature = [
                "name" => $setting[0],
                "function" => $setting[1],
                "image" => \App\Helpers\DigitalSignature::image(
                    name: implode(' - ', $setting),
                    base64: true,
                    hide_time: true,
                    hide_date: true,
                    width: 200
                )
            ];
        }

        return pdf()
                ->view('livewire.ce.pdf', [
                    'ce' => $ce,
                    'signature' => $signature,
                ])
                ->name('ce-' . $ce->id . '.pdf');
    }
}
