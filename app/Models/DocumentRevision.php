<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trait\HasFilter;

class DocumentRevision extends Model
{
    use HasFactory, HasFilter;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'files' => 'array',
    ];

    public const SYSTEM_COLUMNS = [
        'title' => [
            'type' => 'text',
            'label' => 'Title',
            'required' => true,
            'placeholder' => '',
            'filter' => 'search',
            'container' => [
                'class' => 'grid gap-6 mb-6 md:grid-cols-3 md:col-span-3'
            ]
        ],
        'introduction' => [
            'type' => 'textarea',
            'label' => 'Introduction',
            'required' => false,
            'placeholder' => 'A short introduction to the document',
            'filter' => 'search'
        ],
        'content' => [
            'type' => 'rich_text',
            'label' => 'Content',
            'required' => false,
            'placeholder' => 'The content of this document',
            'filter' => 'search'
        ],
        'review_interval' => [
            'type' => 'radios',
            'label' => 'Review Interval',
            'options' => [
                '3' => '3 Months',
                '6' => '6 Months',
                '12' => '12 Months',
                '18' => '18 Months',
                '24' => '24 Months',
                '36' => '36 Months',
            ],
            'filter' => 'search'
        ],
        'lastest_review_date' => [
            'type' => 'date',
            'label' => 'Lastest Review Date',
            'filter' => 'date'
        ],
        'next_review_date' => [
            'type' => 'date',
            'label' => 'Next Review Date',
            'filter' => 'date'
        ]
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
