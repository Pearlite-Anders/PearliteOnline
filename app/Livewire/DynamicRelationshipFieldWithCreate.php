<?php

namespace App\Livewire;

use App\Data\InternalOrderData;
use App\Livewire\Backoffice\InternalOrder\Form as InternalOrderForm;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Modelable;

class DynamicRelationshipFieldWithCreate extends Component
{
    public $column;
    public InternalOrderForm $form;
    private $checksum;

    #[Reactive]
    public $foreign_key;
    public $previous_selected_value;

    #[Modelable]
    public $value = '';
    public $showCreatePopup = false;

    public function mount($column)
    {
        $this->checksum = md5($this->value);
        $this->column = $column;

        $this->form->data = InternalOrderData::from(['name' => '', 'status' => 'active']);
    }

    public function getChoices()
    {

        if(!$this->foreign_key) {
            return [];
        }

        $model = $this->column['through_class'];
        $model = $model::find($this->foreign_key);
        $plural_modal = Str::plural(Str::lower(Str::replace('App\Models\\', '', $this->column['class'])));
        $collection = $model->{$plural_modal};
        if(is_array($this->column['class']::LABEL_KEY)) {
            return $collection->mapWithKeys(function($item) {
                $array = array_map(function($key) use ($item) {
                    if(preg_match('/^data\./', $key)) {
                        return optional($item->data)[Str::replace('data.', '', $key)];
                    }
                    return $item->{$key};
                }, $this->column['class']::LABEL_KEY);

                return [$item->id => implode(' - ', $array)];
            })->toArray();
        }
        return $collection->pluck($this->column['class']::LABEL_KEY, 'id')->toArray();
    }

    public function create()
    {
        $model = $this->column['class']::create([
            'company_id' => $this->form->company_id,
            'data' => $this->form->data->toArray()
        ]);

        $this->value = $model->id;
        $this->form ->data = InternalOrderData::from(['name' => '', 'status' => 'active']);
        $this->showCreatePopup = false;

        $choices = $this->column['class']::get_choices([auth()->user()->currentCompany->id]);
        $this->dispatch(
            'refreshChoices',
            $choices,
            $this->value,
            $this->column['key']
        );
    }

    public function render()
    {
        $choices = $this->getChoices();
        if(
            $this->checksum !== md5($this->value) &&
            $this->foreign_key &&
            $this->previous_selected_value !== $this->foreign_key
        ) {
            if (!in_array($this->value, array_keys($choices))) {
                $this->value = null;
            }
            $this->previous_selected_value = $this->foreign_key;
            $this->dispatch(
                'refreshChoices',
                $this->getChoices(),
                $this->value,
                $this->column['key']
            );
        }

        return view('livewire.dynamic-relationship-field-with-create')->with([
            'choices' => $choices
        ]);
    }
}
