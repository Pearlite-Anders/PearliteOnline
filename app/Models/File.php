<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class File extends Model
{
    use HasFactory;

    public static function fromTemporaryUpload(TemporaryUploadedFile $uploaded_file, $model, $company_id = '')
    {
        if(empty($company_id)) {
            $company_id = $model->company_id;
        }


        $file = new self();
        $file->company_id = $company_id ? $company_id : $company_id;
        $file->name = $uploaded_file->getClientOriginalName();
        $file->path = $uploaded_file->store(config('app.env') .'/'. $file->company_id . '/files', 's3');
        $file->size = $uploaded_file->getSize();
        $file->fileable_type = get_class($model);
        $file->fileable_id = $model->id;
        $file->save();

        return $file;
    }
}
