<?php

namespace App\Livewire\Wpqr;

use App\Data\WpqrData;
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

        return redirect()->route('wpqr.index')->with('flash.banner', __('WPQR created.'));
    }

    public function mount()
    {
        $this->form->data = WpqrData::from(['name' => '', 'status' => 'active']);
    }

    public function render()
    {
        return view('livewire.wpqr.create');
    }
}
