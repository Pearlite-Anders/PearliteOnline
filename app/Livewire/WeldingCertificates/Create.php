<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\WeldingCertificate;
use App\Data\WeldingCertificateData;

class Create extends Component
{
    use Shared, WithFileUploads;

    public Form $form;

    public function create()
    {
        // $this->form->validate();
        $weldingCertificate = $this->form->create();

        return redirect()->route('welding-certificates.index')->with('flash.banner', 'Welding Certificate created.');
    }

    public function mount()
    {
        $this->form->data = WeldingCertificateData::from(['number' => '']);
    }

    public function render()
    {
        return view('livewire.welding-certificates.create');
    }
}
