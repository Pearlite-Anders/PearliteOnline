<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;

trait WithTrixUploads
{

    public $trix_files = [];

    public function completeUpload($uploadedUrl, $eventName)
    {
        foreach ($this->trix_files as $key => $file) {
            if ($file->getFilename() === $uploadedUrl) {

                $newFileName = $file->store(config('app.env') .'/'. auth()->user()->current_company_id, 's3_public');
                $url = Storage::disk('s3_public')->url($newFileName);

                $this->dispatch($eventName, $url);

                return;
            }
        }
    }

    public function removeTrixUpload($file)
    {
        $path = parse_url($file, PHP_URL_PATH);
        $path = ltrim($path, '/');
        Storage::disk('s3_public')->delete($path);
    }

}
