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
        return;
        dd($this);
        // $this->form->validate();
        $this->form->create();

        return redirect()->route('ce.index')->with('flash.banner', __('CE Marking created.'));
    }

    public function mount()
    {
        $this->form->data = CeData::from(['name' => '']);
    }

    public function render()
    {
        return view('livewire.ce.create');
    }
}
