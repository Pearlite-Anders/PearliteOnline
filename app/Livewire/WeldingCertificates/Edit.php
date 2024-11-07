<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\WeldingCertificate;

class Edit extends Component
{
    use Shared, WithFileUploads;

    public Form $form;
    public WeldingCertificate $weldingCertificate;

    public function update()
    {

        $this->form->update($this->weldingCertificate);

        return redirect()
                ->route('welding-certificates.index')
                ->with('flash.banner', 'Welding Certificate updated.');
    }

    #[On('welding-certificate-signed')]
    public function updateWeldingCertificate()
    {
        $this->weldingCertificate = $this->weldingCertificate->refresh();
        $this->form->setFields($this->weldingCertificate);
    }

    public function mount(WeldingCertificate $weldingCertificate)
    {
        $this->authorize('update', $weldingCertificate);
        $this->weldingCertificate = $weldingCertificate;
        $this->form->setFields($weldingCertificate);
    }

    public function render()
    {
        return view('livewire.welding-certificates.edit');
    }
}
