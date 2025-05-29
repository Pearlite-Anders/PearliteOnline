<?php

namespace App\Livewire\WeldingCertificates;

use App\Livewire\DataTable\WithDelete;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\File;
use App\Models\WeldingCertificate;

class Edit extends Component
{
    use Shared, WithFileUploads, WithDelete;

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

    public function delete($id)
    {
        $weldingCertificate = $this->weldingCertificate;
        $this->authorize('update', $weldingCertificate);
        $previous_files = collect($this->weldingCertificate->previous_files);
        if (!$previous_files->first(fn($file) => $file == $id)) {
            return;
        }

        $file = File::find($id);
        if (!$file) {
            return;
        }


        $weldingCertificate->previous_files = $previous_files->filter(fn($file) => $file != $id)->toArray();
        $weldingCertificate->save();
        $file->delete();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Deleted successfully.')
        );
    }

    public function render()
    {
        return view('livewire.welding-certificates.edit');
    }
}
