<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public const LABEL_KEY = ['data.name'];

    public const SYSTEM_COLUMNS = [
        'name' => [
            'type' => 'text',
            'label' => 'Company name',
            'required' => true,
            'placeholder' => 'Materialeudlejning Aps',
            'filter' => 'search'
        ],
        'file' => [
            'type' => 'file',
            'label' => 'Logo',
        ],
        'services' => [
            'type' => 'text',
            'label' => 'Company services',
            'required' => true,
            'placeholder' => 'Lift',
            'filter' => 'search'
        ],
        'contact_name' => [
            'type' => 'text',
            'label' => 'Contact person',
            'required' => true,
            'placeholder' => 'Hans Hansen',
            'filter' => 'search'
        ],
        'phone' => [
            'type' => 'text',
            'label' => 'Phone',
            'required' => true,
            'placeholder' => '87654321',
            'filter' => 'search'
        ],
        'email' => [
            'type' => 'text',
            'label' => 'Email',
            'required' => true,
            'placeholder' => 'Hans@materialeudlejning.dk',
            'filter' => 'search'
        ],
        'responsible_user_id' => [
            'type' => 'relationship',
            'relationship' => 'responsible_user',
            'class' => User::class,
            'label' => 'Responsible user',
            'placeholder' => 'Choose user',
            'filter' => 'relationship'
        ],
        'critical' => [
            'type' => 'radios',
            'multiple' => false,
            'label' => 'Critical',
            'options' => [
                'yes' => 'Yes',
                'no' => 'No',
            ],
            'filter' => 'radios',
            'default' => 'no'
        ],
        'needs_assessment' => [
            'type' => 'radios',
            'multiple' => false,
            'label' => 'Needs assessment',
            'options' => [
                'yes' => 'Yes',
                'no' => 'No',
            ],
            'filter' => 'radios',
            'default' => 'yes'
        ],
        'status' => [
            'type' => 'radios',
            'multiple' => false,
            'label' => 'Active/Inactive',
            'options' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
            ],
            'filter' => 'radios',
            'default' => 'active'
        ],
        'assessment_frequency' => [
            'type' => 'select',
            'multiple' => false,
            'label' => 'Assessment frequency',
            'options' => 'supplier_assessment_frequencies',
            'placeholder' => 'Choose',
            'filter' => 'select',
            'postfix' => ' months'
        ],
        'next_assessment' => [
            'type' => 'calculated',
            'label' => 'Next assessment',
            'filter' => 'date'
        ],
        'remarks' => [
            'type' => 'textarea',
            'label' => 'Remarks',
            'required' => true,
            'placeholder' => 'Service agreement will be made in March.',
            'filter' => 'search'
        ],
    ];

    public function loadAll()
    {
        return $this;
    }

    public function responsible_user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(SupplierReport::class)->orderBy('data->assessment_date', 'asc');
    }

    public function getNextAssessmentAttribute()
    {
        $next_assessment = $this->nextAssessment();
        return $next_assessment ? $next_assessment->format('Y.m.d') : null;
    }

    public function nextAssessment()
    {
        if(!$this->reports->count()) {
            return null;
        }

        $last_report = $this->reports->last();
        $date = Carbon::createFromFormat('Y.m.d', $last_report->data['assessment_date']);

        return $date->addMonths($this->data['assessment_frequency']);
    }
}
