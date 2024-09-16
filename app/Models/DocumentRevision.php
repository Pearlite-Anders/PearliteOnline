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
            'filter' => 'search'
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
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
