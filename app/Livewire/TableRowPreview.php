<?php

namespace App\Livewire;

use Livewire\Component;

class TableRowPreview extends Component
{
    public $model;
    public $edit_link;
    public $can_edit;
    public $show_modal = false;

    public function mount($model, $edit_link, $can_edit)
    {
        $this->model = $model;
        $this->edit_link = $edit_link;
        $this->can_edit = $can_edit;
    }

    public function toggleModal()
    {
        $this->show_modal = !$this->show_modal;
    }

    public function render()
    {
        return view('livewire.table-row-preview');
    }
}
