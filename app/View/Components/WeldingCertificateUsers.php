<?php

namespace App\View\Components;

use App\Models\User;
use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeldingCertificateUsers extends Component
{
    public $companyUd;
    public $users;
    /**
     * Create a new component instance.
     */
    public function __construct($companyId)
    {
        $this->companyId = $companyId;
        $this->users = User::find(Setting::get('welding_certificate_notification_users', [], $companyId));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.welding-certificate-users');
    }
}
