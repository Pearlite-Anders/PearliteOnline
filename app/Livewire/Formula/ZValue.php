<?php

namespace App\Livewire\Formula;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;

class ZValue extends Component
{
    #[Url]
    public $shape;
    #[Url]
    public $shrinkage;
    #[Url]
    public $preheating;
    #[Url]
    public $static;

    public $rows = [
        [
            'depth' => '< 7',
            'depth_multiplier' => 0,
            'a' => '5',
        ],
        [
            'depth' => '10',
            'a' => '7',
            'depth_multiplier' => 3,
        ],
        [
            'depth' => '11',
            'a' => '8',
            'depth_multiplier' => 6,
        ],
        [
            'depth' => '14',
            'a' => '10',
            'depth_multiplier' => 6,
        ],
        [
            'depth' => '17',
            'a' => '12',
            'depth_multiplier' => 6,
        ],
        [
            'depth' => '20',
            'a' => '14',
            'depth_multiplier' => 6,
        ],
        [
            'depth' => '22',
            'a' => '16',
            'depth_multiplier' => 9,
        ],
        [
            'depth' => '25',
            'a' => '18',
            'depth_multiplier' => 9,
        ],
        [
            'depth' => '29',
            'a' => '21',
            'depth_multiplier' => 9,
        ],
        [
            'depth' => '32',
            'a' => '23',
            'depth_multiplier' => 12,
        ],
        [
            'depth' => '35',
            'a' => '25',
            'depth_multiplier' => 12,
        ],
        [
            'depth' => '39',
            'a' => '28',
            'depth_multiplier' => 12,
        ],
        [
            'depth' => '42',
            'a' => '30',
            'depth_multiplier' => 15,
        ],
        [
            'depth' => '45',
            'a' => '32',
            'depth_multiplier' => 15,
        ],
        [
            'depth' => '49',
            'a' => '35',
            'depth_multiplier' => 15,
        ]
    ];

    public $columns = [
        [
            'label' => 3,
            'thinkness_multiplier' => 2,
        ],
        [
            'label' => 4,
            'thinkness_multiplier' => 2,
        ],
        [
            'label' => 5,
            'thinkness_multiplier' => 2,
        ],
        [
            'label' => 6,
            'thinkness_multiplier' => 2,
        ],
        [
            'label' => 8,
            'thinkness_multiplier' => 2,
        ],
        [
            'label' => 10,
            'thinkness_multiplier' => 2,
        ],
        [
            'label' => 12,
            'thinkness_multiplier' => 4,
        ],
        [
            'label' => 15,
            'thinkness_multiplier' => 4,
        ],
        [
            'label' => 20,
            'thinkness_multiplier' => 4,
        ],
        [
            'label' => 25,
            'thinkness_multiplier' => 6,
        ],
        [
            'label' => 30,
            'thinkness_multiplier' => 6,
        ],
        [
            'label' => 35,
            'thinkness_multiplier' => 8,
        ],
        [
            'label' => 40,
            'thinkness_multiplier' => 8,
        ],
        [
            'label' => 50,
            'thinkness_multiplier' => 10,
        ],
        [
            'label' => 60,
            'thinkness_multiplier' => 12,
        ],
        [
            'label' => 70,
            'thinkness_multiplier' => 15,
        ],
    ];

    #[Computed]
    public function values()
    {
        $values = [];
        foreach($this->rows as $row_index => $row) {
            foreach($this->columns as $column_index => $column) {
                $depth_multiplier = $row['depth_multiplier'];
                $thickness_multiplier = $column['thinkness_multiplier'];
                $z_value = $depth_multiplier + $this->shape + $thickness_multiplier + $this->shrinkage * $this->preheating + $this->static;
                $label = '-';
                if($z_value >= 10 && $z_value < 20) {
                    $label = 'Z15';
                } elseif($z_value >= 20 && $z_value < 30) {
                    $label = 'Z25';
                } elseif($z_value >= 30 && $z_value < 40) {
                    $label = 'Z35';
                }

                $values[$row_index][$column_index] = [
                    'z_value' => $z_value,
                    'label' => $label
                ];
            }
        }

        return $values;
    }

    public function render()
    {
        return view('livewire.formula.z-value');
    }
}
