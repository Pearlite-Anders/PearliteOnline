<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use ComputedAttributes, WithFileUploads;

    public Form $form;

    public function create()
    {
        // $this->form->validate();

        $weldingCertificate = $this->form->create();

        return redirect()->route('welding-certificates.index')->with('flash.banner', 'Welding Certificate created.');

    }

    public function render()
    {
        return view('livewire.welding-certificates.create');
    }
}
