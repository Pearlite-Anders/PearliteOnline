<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Trait\HasCompany;

class Document extends Model
{
    use HasFactory, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'files' => 'array',
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
}
