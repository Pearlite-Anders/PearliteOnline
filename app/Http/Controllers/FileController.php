<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, File $file)
    {
        if (! $request->hasValidSignature()) {
            abort(404);
        }

        if(!Storage::disk(File::$default_disk)->exists($file->path)) {
            abort(404);
        }

        return Storage::disk(File::$default_disk)->download($file->path, $file->name, [
            'Content-Disposition' => 'inline; filename="' . urlencode($file->name) . '"', // Display inline in browser, not download
        ]);
    }
}
