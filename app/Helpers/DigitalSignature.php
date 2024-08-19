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
        $hide_time = false,
        $hide_date = false,
        $width = 302
    ): string {
        $date = now()->setTimezone('Europe/Copenhagen');
        $originalWidth = 302;
        $originalHeight = 72;


        // create new manager instance with desired driver
        $manager = new ImageManager(Driver::class);
        $image = $manager->create($originalWidth, $originalHeight);

        $image->text($header, 5, 15, function ($font) {
            $font->filename(resource_path('fonts/Roboto-Bold.ttf'));
            $font->size(12);
            $font->color('#0891b2');
        });

        $image->text($name, 5, 45, function ($font) {
            $font->filename(resource_path('fonts/Roboto-Regular.ttf'));
            $font->size(18);
            $font->color('#000');
        });

        if (!$hide_date) {
            $image->text($date->format('Y.m.d'.($hide_time ? '' : ' - H:i')), 5, 65, function ($font) {
                $font->filename(resource_path('fonts/Roboto-Regular.ttf'));
                $font->size(18);
                $font->color('#000');
            });
        }

        // Add a border to the image
        $image->drawRectangle(0, 0, function ($draw) use ($originalWidth, $originalHeight) {
            $draw->size($originalWidth - 1, $originalHeight - 1);
            $draw->border('#0891b2', 2);
        });

        // if originalWidth is not equal to width
        if ($originalWidth !== $width) {
            $image->scaleDown($width);
        }

        if ($base64) {
            return (string) $image->toPng()->toDataUri();
        } else {
            $image->save(Storage::disk('local')->path('livewire-tmp/'.uniqid().'.png'));
            return Storage::disk('local')->path('livewire-tmp/'.uniqid().'.png');
        }
    }
}