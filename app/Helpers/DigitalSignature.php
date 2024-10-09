<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Imagick\Driver;

class DigitalSignature
{
    public static function image(
        $name,
        $header = 'Digital Signatur',
        $base64 = false,
        $extra_text = null,
        $width = 302,
        $color = '#991b1b'
    ): string {
        $date = now()->setTimezone('Europe/Copenhagen');
        $originalWidth = 302;
        $originalHeight = 72;


        // create new manager instance with desired driver
        $manager = new ImageManager(Driver::class);
        $image = $manager->create($originalWidth, $originalHeight);

        $image->text($header, 5, 22, function ($font) use ($color) {
            $font->filename(resource_path('fonts/Roboto-Bold.ttf'));
            $font->size(18);
            $font->color($color);
        });

        $image->text($name, 5, 45, function ($font) {
            $font->filename(resource_path('fonts/Roboto-Regular.ttf'));
            $font->size(18);
            $font->color('#000');
        });

        if ($extra_text) {
            $image->text($extra_text, 5, 65, function ($font) {
                $font->filename(resource_path('fonts/Roboto-Regular.ttf'));
                $font->size(18);
                $font->color('#000');
            });
        }

        // Add a border to the image
        $image->drawRectangle(0, 0, function ($draw) use ($originalWidth, $originalHeight, $color) {
            $draw->size($originalWidth - 1, $originalHeight - 1);
            $draw->border($color, 2);
        });

        // if originalWidth is not equal to width
        if ($originalWidth !== $width) {
            $image->scaleDown($width);
        }

        if ($base64) {
            return (string) $image->toPng()->toDataUri();
        } else {
            $unique = uniqid();
            $image->save(Storage::disk('local')->path('livewire-tmp/'.$unique.'.png'));
            return Storage::disk('local')->path('livewire-tmp/'.$unique.'.png');
        }
    }
}
