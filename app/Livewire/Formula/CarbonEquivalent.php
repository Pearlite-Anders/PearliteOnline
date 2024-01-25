<?php

namespace App\Livewire\Formula;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;

class CarbonEquivalent extends Component
{
    #[Url]
    public $c;
    #[Url]
    public $mn;
    #[Url]
    public $cr;
    #[Url]
    public $mo;
    #[Url]
    public $v;
    #[Url]
    public $ni;
    #[Url]
    public $cu;

    #[Computed]
    public function ce()
    {
        $c = str_replace(',', '.', $this->c);
        $mn = str_replace(',', '.', $this->mn);
        $cr = str_replace(',', '.', $this->cr);
        $mo = str_replace(',', '.', $this->mo);
        $v = str_replace(',', '.', $this->v);
        $ni = str_replace(',', '.', $this->ni);
        $cu = str_replace(',', '.', $this->cu);

        if ($c == null || $mn == null || $cr == null || $mo == null || $v == null || $ni == null || $cu == null) {
            return null;
        }

        return number_format($c + ($mn / 6) + (($cr + $mo + $v) / 5) + (($ni + $cu) / 15), 3, ',', '.');
    }

    #[Computed]
    public function cet()
    {
        $c = str_replace(',', '.', $this->c);
        $mn = str_replace(',', '.', $this->mn);
        $cr = str_replace(',', '.', $this->cr);
        $mo = str_replace(',', '.', $this->mo);
        $v = str_replace(',', '.', $this->v);
        $ni = str_replace(',', '.', $this->ni);
        $cu = str_replace(',', '.', $this->cu);

        if ($c == null || $mn == null || $cr == null || $mo == null || $v == null || $ni == null || $cu == null) {
            return null;
        }

        return number_format($c + (($mn + $mo) / 10) + (($cr + $cu) / 20) + ($ni / 40), 3, ',', '.');
    }


    public function render()
    {
        return view('livewire.formula.carbon-equivalent');
    }
}
