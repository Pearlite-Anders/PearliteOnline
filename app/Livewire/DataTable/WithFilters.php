<?php

namespace App\Livewire\DataTable;

use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Reactive;

trait WithFilters
{
    use BaseFilters;

    public $filter_columns = [];
    #[Url]
    public $filters = [];
    public $preset_filters = [];
    public $hide_filters = false;
    public $showFilterSettingsModal = false;
}
