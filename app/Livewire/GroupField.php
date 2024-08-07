<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class GroupField extends Component
{

    public $column;
    public $form;

    #[Modelable]
    public $value = [];

    public function mount()
    {
        if(
            is_null($this->value) ||
            empty($this->value) ||
            is_string($this->value)
        ){
            $this->value = [];
            $this->value = [$this->getNewRow()];
        }
    }

    public function addRow()
    {
        $this->value[] = $this->getNewRow();
    }

    public function removeRow($index)
    {
        unset($this->value[$index]);
    }

    public function getNewRow()
    {
        $row = [];
        foreach($this->column['fields'] as $key => $field){
            $row[$key] = $field['multiple'] ? [] : '';
        }

        return $row;
    }

    public function render()
    {
        return view('livewire.group-field');
    }
}
