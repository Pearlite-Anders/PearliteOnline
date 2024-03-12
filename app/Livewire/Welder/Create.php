<?php

namespace App\Livewire\Welder;

use App\Data\WelderData;
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

        return redirect()->route('welder.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->form->data = WelderData::from(['name' => '', 'status' => 'active']);
    }

    public function render()
    {
        return view('livewire.welder.create');
    }
}
