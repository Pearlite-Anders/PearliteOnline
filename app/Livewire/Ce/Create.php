<?php

namespace App\Livewire\Ce;

use App\Data\CeData;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;

    public function create()
    {
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('ce.index')->with('flash.banner', __('CE Marking created.'));
    }

    public function mount()
    {
        $this->form->data = CeData::from([
            'year' => now()->format('y'),
            'name' => '',
            'standard' => 'EN 1090-1:2009 + A1:2011',
            'behavior_in_fire' => 'A1',
            'tolerance_class' => 'Klasse 1',
            'durability_group' => [
                [
                    'surface' => '',
                    'corrosivity_category' => '',
                    'expected_durability' => '',
                    'prepration_grade' => '',
                ]
            ],
        ]);
    }

    public function render()
    {
        return view('livewire.ce.create');
    }
}
