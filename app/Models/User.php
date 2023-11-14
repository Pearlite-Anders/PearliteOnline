<?php

namespace App\Models;

use App\Data\UserFilters;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;

    public const ADMIN_ROLE = 'admin';
    public const PARTNER_ROLE = 'partner';
    public const USER_ROLE = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'current_company_id', 'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'filters' => 'array',
        'columns' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public const LABEL_KEY = 'name';

    public function getLabel()
    {
        return $this->name;
    }

    /**
     * Get all of the companies the user owns or belongs to.
     *
     * @return \Illuminate\Support\Collection
     */
    public function companies()
    {
        if ($this->isAdmin()) {
            return Company::query();
        }
        return $this->belongsToMany(Company::class);
    }

    public function getCompaniesAttribute()
    {
        if ($this->isAdmin()) {
            return Company::all();
        }

        return $this->getRelationValue('companies');
    }

    public function currentCompany()
    {
        return $this->belongsTo(Company::class, 'current_company_id');
    }

    public function isAdmin()
    {
        return $this->role === self::ADMIN_ROLE;
    }

    public function isPartner()
    {
        return $this->role === self::PARTNER_ROLE;
    }

    public function isUser()
    {
        return $this->role === self::USER_ROLE;
    }

    public function getColumns($type)
    {
        $columns = $this->columns[$type] ?? [];

        if (empty($columns)) {
            $columns = $type::getDefaultColumns();
        } else {
            $columns = collect(json_decode(json_encode($columns)));
        }

        return $columns;
    }

    public function saveColumns($type, $columns)
    {
        $user_columns = $this->columns ?? [];
        $user_columns[$type] = $columns;
        $this->columns = $user_columns;
        $this->save();
    }

    public function getFilters($type)
    {
        $filters = $this->filters[$type] ?? [];

        if (empty($filters)) {
            $filters = $type::getDefaultfilters();
        } else {
            $filters = collect(json_decode(json_encode($filters)));
        }

        return $filters;
    }

    public function saveFilters($type, $filters)
    {
        $user_filters = $this->filters ?? [];
        $user_filters[$type] = $filters;
        $this->filters = $user_filters;
        $this->save();
    }

    public static function get_choices()
    {
        return auth()->user()->currentCompany->users()->where('role', self::USER_ROLE)->get()->pluck('name', 'id')->toArray();
    }

    public function humanRole()
    {
        switch ($this->role) {
            case self::ADMIN_ROLE:
                return __('Admin');
            case self::PARTNER_ROLE:
                return __('Partner');
            case self::USER_ROLE:
                return __('User');
            default:
                return __('Unknown');
        }
    }
}
