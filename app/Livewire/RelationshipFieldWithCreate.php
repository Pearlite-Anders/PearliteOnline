<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class RelationshipFieldWithCreate extends Component
{
    public $column;
    public $form;

    #[Modelable]
    public $value = '';
    public $showCreatePopup = false;

    public function create()
    {
        $model = $this->column['class']::create([
            'company_id' => auth()->user()->currentCompany->id,
            'data' => $this->form->data->toArray()
        ]);

        $this->value = $model->id;
        $this->form = (object)[
            'data' => $this->column['data_class']::from(['name' => ''])
        ];
        $this->showCreatePopup = false;

        $choices = $this->column['class']::get_choices([auth()->user()->currentCompany->id]);
        $this->dispatch(
            'refreshChoices',
            $choices,
            $this->value,
            $this->column['key']
        );
    }


    public function mount($column)
    {
        $this->column = $column;

        $this->form = (object)[
            'data' => $column['data_class']::from(['name' => ''])
        ];
    }

    public function render()
    {
        return view('livewire.relationship-field-with-create')->with([
            'choices' => $this->column['class']::get_choices([auth()->user()->currentCompany->id])
        ]);
    }
}
