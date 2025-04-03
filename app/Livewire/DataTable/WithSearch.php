<?php

namespace App\Livewire\DataTable;

use Livewire\Attributes\Url;

trait WithSearch
{
    use BaseSearch;
    #[Url]
    public $search = '';

    public $hide_search = false;
}
