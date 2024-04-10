<?php

namespace App\Livewire\TimeRegistration;

use App\Models\Setting;
use Livewire\Component;

class Settings extends Component
{

    public $settings = [];
    public $confirming;

    public function save()
    {
        Setting::updateOrCreate([
            'company_id' => 0,
            'key' => 'time_registration_tasks',
        ], [
            'value' => $this->settings,
        ]);
    }


    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function cancelConfirmDelete()
    {
        $this->confirming = null;
    }
    public function deleteArrayItem($key)
    {
        unset($this->settings[$key]);
    }

    public function addArrayItem($value = '')
    {
        $unique_id = uniqid();
        $this->settings[$unique_id] = $value;
    }

    public function mount()
    {
        $this->settings = Setting::get('time_registration_tasks', [], 0);
    }

    public function render()
    {
        return view('livewire.time-registration.settings');
    }
}
