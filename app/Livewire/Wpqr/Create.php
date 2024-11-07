<?php

namespace App\Livewire\Wpqr;

use App\Data\WpqrData;
use App\Models\Wpqr;
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
        $this->authorize('create', new Wpqr());
        $this->form->data = WpqrData::from(['name' => '', 'status' => 'active']);
        $this->form->project_id = request('project_id');
    }

    public function render()
    {
        return view('livewire.wpqr.create');
    }
}
