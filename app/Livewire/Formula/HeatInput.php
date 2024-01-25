<?php

namespace App\Livewire\Formula;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;

class HeatInput extends Component
{
    #[Url]
    public $v;
    #[Url]
    public $a;
    #[Url]
    public $t;
    #[Url]
    public $l;
    #[Url]
    public $k_factor;

    #[Computed]
    public function heat_input()
    {
        $v = str_replace(',', '.', $this->v);
        $a = str_replace(',', '.', $this->a);
        $t = str_replace(',', '.', $this->t);
        $l = str_replace(',', '.', $this->l);
        $k_factor = str_replace(',', '.', $this->k_factor_value());

        if ($v == null || $a == null || $t == null || $l == null || $k_factor == null) {
            return null;
        }

        return number_format(($v * $a * $t * $k_factor) / ($l * 1000), 3, ',', '.');
    }

    #[Computed]
    public function k_factor_value() {
        if(in_array($this->k_factor, [12])) {
            return '1,0';
        }

        if(in_array($this->k_factor, [111, 131, 135, 114, 136, 137])) {
            return '0,8';
        }

        if(in_array($this->k_factor, [141, 15])) {
            return '0,6';
        }


        return null;
    }

    public function render()
    {
        return view('livewire.formula.heat-input');
    }
}
