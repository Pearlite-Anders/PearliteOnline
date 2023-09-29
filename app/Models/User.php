<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
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
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

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
}
