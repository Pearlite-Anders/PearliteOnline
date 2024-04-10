<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Modelable;

class DynamicRelationshipField extends Component
{
    public $column;
    public $form;
    private $checksum;

    #[Reactive]
    public $relation;
    public $lastRelation;

    #[Modelable]
    public $value = '';

    public function mount()
    {
        $this->checksum = md5($this->value);
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


        return view('livewire.dynamic-relationship-field')->with([
            'choices' => []
        ]);
    }

    public function getChoices()
    {
        $model = 'App\Models\\' . Str::ucfirst($this->column['relationship']);
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
}
