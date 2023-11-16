<?php

namespace App\Livewire\DataTable;

trait WithClickableRow {

    public function gotoEdit($link)
    {
        return redirect()->to($link);
    }
}
