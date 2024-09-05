<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Concerns\WireableData;
class DocumentData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public ?string $title,
        public ?string $introduction,
        public ?string $content,
        public ?bool $default_view,
        public ?bool $default_edit,
    ) { }
}
