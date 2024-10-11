<?php

namespace App\Livewire;

use App\Data\InternalOrderData;
use App\Livewire\InternalOrder\Form as InternalOrderForm;

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
    public $relation;
    public $lastRelation;

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
        if(!$this->relation) {
            return [];
        }

        $model = Str::remove('_id', $this->column['relationship']);
        $model = 'App\Models\\' . Str::ucfirst($model);
        $model = $model::find($this->relation);
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
            'company_id' => auth()->user()->currentCompany->id,
            'data' => $this->form->data->toArray()
        ]);

        $this->value = $model->id;
        $this->form ->data = InternalOrderData::from(['name' => '', 'status' => 'active']);
        $this->showCreatePopup = false;

        $choices = $this->column['class']::get_choices();
        $this->dispatch(
            'refreshChoices',
            $choices,
            $this->value,
            $this->column['key']
        );
    }

    public function render()
    {

        if(
            $this->checksum !== md5($this->value) &&
            $this->relation &&
            $this->lastRelation !== $this->relation
        ) {
            $this->value = '';
            $this->lastRelation = $this->relation;
            $this->dispatch(
                'refreshChoices',
                $this->getChoices(),
                $this->value,
                $this->column['key']
            );
        }

        return view('livewire.dynamic-relationship-field-with-create')->with([
            'choices' => $this->getChoices()
        ]);
    }
}
