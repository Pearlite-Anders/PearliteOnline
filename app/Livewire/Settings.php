<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Url;

class Settings extends Component
{

    public $settings;

    #[Url]
    public $section;

    public $confirming;

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function cancelConfirmDelete()
    {
        $this->confirming = null;
    }

    public function setSection($section)
    {
        $this->section = $section;
    }

    public function deleteArrayItem($array, $key)
    {
        unset($this->settings[$array][$key]);
    }

    public function addArrayItem($array, $value = '')
    {
        $unique_id = uniqid();
        $this->settings[$array][$unique_id] = $value;
    }

    public function save()
    {
        foreach($this->settings as $key => $value) {
            Setting::updateOrCreate([
                'company_id' => auth()->user()->currentCompany->id,
                'key' => $key,
            ], [
                'value' => $value,
            ]);
        }
    }

    public function mount()
    {
        $this->settings = Setting::all()->toArray();
        $this->section = request()->get('section', 'welding-certificates');
    }

    public function render()
    {
        return view('livewire.settings.settings');
    }
}
