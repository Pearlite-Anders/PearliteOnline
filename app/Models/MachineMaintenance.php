<?php

namespace App\Models;

use App\Models\Trait\HasFilter;
use App\Models\Trait\HasCompany;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MachineMaintenance extends Model
{
    use HasFactory, SoftDeletes, HasFilter, HasCompany;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'images' => 'array',
        'files' => 'array',
    ];

    public const LABEL_KEY = 'data.name';

    public const SYSTEM_COLUMNS = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'required' => true,
            'filter' => 'search'
        ],
        'type' => [
            'type' => 'select',
            'label' => 'Type',
            'options' => 'machine_maintenance_types',
            'multiple' => false,
            'placeholder' => 'Choose',
            'filter' => 'select'
        ],
        'brand' => [
            'type' => 'text',
            'label' => 'Brand',
            'filter' => 'search'
        ],
        'serial_number' => [
            'type' => 'text',
            'label' => 'Serial Number',
            'filter' => 'search'
        ],
        'internal_number' => [
            'type' => 'text',
            'label' => 'Internal Number',
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
        'next_maintenance_date' => [
            'type' => 'date',
            'label' => 'Next Maintenance Date',
            'filter' => 'date',
            'indicator' => true
        ],
        'maintenance_interval' => [
            'type' => 'radios',
            'label' => 'Maintenance Interval',
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
    ];

    public function loadAll()
    {
        return $this;
    }


    public function reports()
    {
        return $this->hasMany(MachineMaintenanceMaintenance::class)->orderBy('data->maintenance_date', 'desc');
    }

    public function responsible_user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getNextMaintenanceDateAttribute()
    {
        $next_maintenance_date = $this->nextMaintenanceDate();
        return $next_maintenance_date ? $next_maintenance_date->format('Y.m.d') : null;
    }

    public function getLatestMaintenanceDateAttribute()
    {
        $latest_maintenance_date = $this->latestMaintenanceDate();
        return $latest_maintenance_date ? $latest_maintenance_date->format('Y.m.d') : null;
    }

    public function nextMaintenanceDate()
    {
        $next_maintenance_date = data_get($this->data, 'next_maintenance_date', null);
        $next_maintenance_date = str_replace('-', '.', $next_maintenance_date);
        if (empty($next_maintenance_date)) {
            return null;
        }

        return Carbon::createFromFormat('Y.m.d', $next_maintenance_date);
    }

    public function latestMaintenanceDate()
    {
        if(!$this->reports->count()) {
            return null;
        }

        $last_report = $this->reports()->first();
        return Carbon::createFromFormat('Y.m.d', $last_report->data['maintenance_date']);
    }

    public function edit_url()
    {
        return route('machine-maintenance.edit', ['machineMaintenance' => $this->id]);
    }

    public function getNeedsReviewAttribute()
    {
        return isset($this->data['status']) && $this->data['status'] == 'active';
    }
}
