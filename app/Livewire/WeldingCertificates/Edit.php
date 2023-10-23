<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Component;
use App\Models\WeldingCertificate;

class Edit extends Component
{
    use ComputedAttributes;

    public Form $form;

    public WeldingCertificate $weldingCertificate;

    public function update()
    {
        $this->form->update($this->weldingCertificate);

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Welding Certificate updated successfully.')
        );
    }

    public function mount(WeldingCertificate $weldingCertificate)
    {
        $this->weldingCertificate = $weldingCertificate;
        $this->form->setFields($weldingCertificate);
    }

    public function render()
    {
        return view('livewire.welding-certificates.edit');
    }
}
