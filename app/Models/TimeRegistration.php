<?php

namespace App\Models;

use App\Data\CompanyData;
use App\Data\ProjectData;
use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeRegistration extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    public const LABEL_KEY = ['data.name'];

    public const SYSTEM_COLUMNS = [
        'company_id' => [
            'type' => 'relationship',
            'relationship' => 'company',
            'class' => Company::class,
            'label' => 'Company',
            'placeholder' => 'Choose company',
            'filter' => 'relationship',
            'create_popup' => false,
            'data_class' => CompanyData::class,
            'multiple' => false,
        ],
        'project_id' => [
            'type' => 'dynamic_relationship',
            'relationship' => 'company_id',
            'class' => Project::class,
            'label' => 'Project',
            'placeholder' => 'Choose project',
            'filter' => 'relationship',
            'create_popup' => false,
            'data_class' => ProjectData::class,
            'multiple' => false,
        ],
        'tasks' => [
            'type' => 'select',
            'multiple' => true,
            'label' => 'Tasks',
            'options' => 'time_registration_tasks',
            'placeholder' => 'Choose',
            'filter' => 'select',
        ],
        'date' => [
            'type' => 'date',
            'label' => 'Date',
            'required' => true,
            'placeholder' => '',
            'filter' => 'date'
        ],
        'hours' => [
            'type' => 'number',
            'label' => 'Timer',
            'required' => true,
            'placeholder' => '',
            'filter' => 'search'
        ],
        'driving' => [
            'type' => 'number',
            'label' => 'Kørsel',
            'required' => false,
            'placeholder' => '',
            'filter' => 'search',
            'postfix' => 'DKK'
        ],
        'expenses' => [
            'type' => 'number',
            'label' => 'Udgifter',
            'required' => false,
            'placeholder' => '',
            'filter' => 'search',
            'postfix' => 'DKK'
        ],
        'remarks' => [
            'type' => 'textarea',
            'label' => 'Remarks',
            'required' => false,
            'placeholder' => '',
            'filter' => 'search'
        ],
    ];

    public function loadAll()
    {
        return $this;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
