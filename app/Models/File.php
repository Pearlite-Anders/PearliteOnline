<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class File extends Model
{
    use HasFactory;

    public static $default_disk = 's3';

    public static function fromTemporaryUpload(TemporaryUploadedFile $uploaded_file, $model, $company_id = '')
    {
        if(empty($company_id)) {
            $company_id = $model->company_id;
        }


        $file = new self();
        $file->company_id = $company_id ? $company_id : $company_id;
        $file->name = $uploaded_file->getClientOriginalName();
        $file->path = $uploaded_file->store(config('app.env') .'/'. $file->company_id . '/files', self::$default_disk);
        $file->size = $uploaded_file->getSize();
        $file->fileable_type = get_class($model);
        $file->fileable_id = $model->id;
        $file->save();

        return $file;
    }

    public function isPDF()
    {
        return preg_match('/\.pdf$/', $this->path);
    }

    public function isImage()
    {
        return preg_match('/\.(jpg|jpeg|png)$/', $this->path);
    }

    public function temporary_url()
    {
        return Storage::disk(self::$default_disk)->temporaryUrl($this->path, now()->addMinutes(60));
    }

    public function temporary_download($return = '')
    {
        $content = Storage::disk(self::$default_disk)->get($this->path);
        $extension = pathinfo($this->path, PATHINFO_EXTENSION);
        $path = 'public/tmpFiles/'.uniqid('temp_pdf', true).'.'. $extension;

        Storage::put($path, $content);
        if($return == 'both') {
            return [
                'url' => url(Storage::disk(self::$default_disk)->url($path)),
                'storage_path' => Storage::disk(self::$default_disk)->path('app/'.$path)
            ];
        }

        return Storage::disk(self::$default_disk)->path('app/'.$path);
    }
}
