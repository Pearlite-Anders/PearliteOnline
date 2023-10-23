<?php

namespace App\Livewire\WeldingCertificates;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\WeldingCertificate;

class Index extends Component
{
    use WithPagination;

    public $confirming;

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function cancelConfirmDelete()
    {
        $this->confirming = null;
    }

    public function delete(WeldingCertificate $weldingCertificate)
    {
        $this->authorize('delete', $weldingCertificate);

        $weldingCertificate->delete();

        $this->dispatch(
            'banner-message',
            style: 'success',
            message: __('Welding certificate deleted successfully.')
        );
    }

    public function render()
    {
        $this->authorize('viewAny', WeldingCertificate::class);
        return view('livewire.welding-certificates.index')->with([
            'weldingCertificates' => auth()->user()->currentCompany->welding_certificates()->paginate(100),
        ]);
    }
}
