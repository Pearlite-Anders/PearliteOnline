<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;

class Document extends Model
{
    use HasFactory, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
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
            'type' => 'rich_text',
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

}
