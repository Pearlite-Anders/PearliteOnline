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

        if($this->form->new_certificate) {
            return redirect()
                    ->route('welding-certificates.edit', $this->weldingCertificate)
                    ->with('flash.banner', 'Welding Certificate updated.');
        }

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
