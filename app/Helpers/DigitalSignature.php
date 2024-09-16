<?php

namespace App\Helpers;

use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class DigitalSignature
{
    public static function image(
        $name,
        $header = 'Digital Signatur',
        $base64 = false,
        $hide_time = false,
        $hide_date = false,
        $width = 302,
        $height = 72
    ): string
    {
        $date = now()->setTimezone('Europe/Copenhagen');

        // create new manager instance with desired driver
        $manager = new ImageManager(Driver::class);
        $image = $manager->create($width, $height);

        $image->text($header, 5, 22, function ($font) {
            $font->filename(resource_path('fonts/Roboto-Bold.ttf'));
            $font->size(22);
            $font->color('#000');
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

        if ($base64) {
            return (string) $image->toPng()->toDataUri();
        } else {
            $image->save(Storage::disk('local')->path('livewire-tmp/'.uniqid().'.png'));
            return Storage::disk('local')->path('livewire-tmp/'.uniqid().'.png');
        }
    }
}
