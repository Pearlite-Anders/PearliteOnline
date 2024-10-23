<?php

namespace App\Models;

use App\Models\Trait\HasCompany;

use App\Models\Trait\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;

class Document extends Model
{
    use HasFactory, HasCompany, HasFilter, NodeTrait;

    protected $guarded = [];

    public const SYSTEM_COLUMNS = [
        'title' => [
            'type' => 'text',
            'label' => 'Document title',
            'required' => true,
            'placeholder' => 'Title',
            'filter' => 'search'
        ],
        'lastest_review_date' => [
            'type' => 'date',
            'label' => 'Latest review Date',
            'filter' => 'date',
        ],
        'next_review_date' => [
            'type' => 'date',
            'label' => 'Next review Date',
            'filter' => 'date',
        ],
        'review_interval' => [
            'type' => 'radios',
            'label' => 'Options Interval',
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
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('view', 'edit')->withTimestamps();
    }

    public function revisions()
    {
        return $this->hasMany(DocumentRevision::class);
    }

    public function currentRevision()
    {
        return $this->hasOne(DocumentRevision::class)->latestOfMany();
    }

    public function removeOldRevision()
    {
        // Remove the oldest 10 revisions. The limit is nessary for MySQL
        $oldRevisions = $this->revisions()->latest()->skip(10)->limit(9)->get();
        foreach($oldRevisions as $oldRevision) {
            $oldRevision->delete();
        }
    }

    protected function getScopeAttributes()
    {
        return ['company_id'];
    }
}
