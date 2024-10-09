<?php

namespace App\Models;

use Intervention\Image\Image;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Intervention\Image\Interfaces\EncoderInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;

    public const ADMIN_ROLE = 'admin';
    public const PARTNER_ROLE = 'partner';
    public const USER_ROLE = 'user';

    public const DEPENDENCIES = [
        'suppliers' => [
            'class' => Supplier::class,
            'foreign_key' => 'responsible_user_id'
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'current_company_id', 'role', 'active',
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
        'data' => 'array',
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

    public function documentsWithPermissons()
    {
        return $this->belongsToMany(Document::class)->withPivot('view', 'edit')->withTimestamps();
    }

    public function ownedDocuments()
    {
        return $this->hasMany(Document::class, 'owner_id');
    }

    public function documents()
    {
        if ($this->isAdmin()) {
            return Document::query();
        }

        return Document::where(function($q) {
            return $q->whereHas('currentRevision', function($query) {
                $query->whereJsonContains('data', ['default_view' => true]);
            })
            ->orWhere('owner_id', $this->id)
            ->orWhereHas('users', function ($query) {
                $query->where('user_id', $this->id)->where(function($permisionQuery) {
                    $permisionQuery->where('view', true)->orWhere('edit', true);
                });
            });
        });
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
            return $type::getDefaultColumns();
        }

        $columns = collect(json_decode(json_encode($columns)));
        $default_columns = $type::getDefaultColumns();

        if($columns->pluck('key')->sort()->values() != $default_columns->pluck('key')->sort()->values()) {
            $default_columns->each(function ($column) use (&$columns) {
                if(!$columns->contains('key', $column->key)) {
                    $columns->push($column);
                }
            });

            $columns = $columns->filter(function ($column) use ($default_columns) {
                return $default_columns->contains('key', $column->key);
            });

            $this->saveColumns($type, $columns);
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
            $default_filters = $type::getDefaultfilters();
            if($filters->pluck('key')->sort()->values() != $default_filters->pluck('key')->sort()->values()) {
                $default_filters->each(function ($filter) use (&$filters) {
                    if(!$filters->contains('key', $filter->key)) {
                        $filters->push($filter);
                    }
                });

                $filters = $filters->filter(function ($filter) use ($default_filters) {
                    return $default_filters->contains('key', $filter->key);
                });

                $this->saveFilters($type, $filters);
            }
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
        return auth()
                ->user()
                ->currentCompany->users()
                ->where('role', self::USER_ROLE)
                ->get()
                ->pluck('name', 'id')
                ->toArray();
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

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo)
    {
        tap($this->profile_photo_path, function ($previous) use ($photo) {
            $file = File::fromTemporaryUpload($photo, $this, $this->current_company_id);

            $this->forceFill(['profile_photo_path' => $file->id,])->save();

            if ($previous) {
                $file = File::find($previous);
                $file->delete();
            }
        });
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        if (is_null($this->profile_photo_path)) {
            return;
        }

        $file = File::find($this->profile_photo_path);
        $file->delete();

        $this->forceFill([
            'profile_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function profilePhotoUrl(): Attribute
    {
        return Attribute::get(function (): string {
            $file = File::find($this->profile_photo_path);
            return $this->profile_photo_path
                    ? $file->temporary_url()
                    : '';
        });
    }

    public function get_digital_signature($base64 = false)
    {
        return \App\Helpers\DigitalSignature::image($this->name, base64: $base64, extra_text: $this->data['title']);
    }

    /**
     * The a list of all dependencies for this user.
     */
    public function dependencies()
    {
        $dependencies = collect([]);
        foreach(array_keys(self::DEPENDENCIES) as $dependency) {
            $dependencies = $dependencies->merge($this->$dependency);
        }

        return $dependencies;
    }

    /**
     * The a list of how many dependecies this user has, including a total.
     */
    public function dependenciesCount()
    {
        $dependencies = collect(['total' => 0]);
        foreach(array_keys(self::DEPENDENCIES) as $dependency) {
            $count = $this->$dependency()->count();
            $dependencies = $dependencies->merge([$dependency => $count]);
            $dependencies['total'] += $count;
        }

        return $dependencies;
    }

    public function hasDependencies()
    {
        return $this->dependenciesCount()->first(fn($dep, $key) => $key != 'total' && $dep > 0) != null;
    }

    /**
     * A small helper to get the the dependencies of the model from DEPENDENCIES, instead of setting it up the function manually
     */
    public function __get($name)
    {
        if (in_array($name, array_keys(self::DEPENDENCIES))) {
            return $this->$name()->get();
        }

        return parent::__get($name);
    }

    /**
     * A small helper to get the the dependencies of the model from DEPENDENCIES, instead of setting it up the function manually
     */
    public function __call($name, $arg)
    {
        if (in_array($name, array_keys(self::DEPENDENCIES))) {
            return $this->hasMany(
                self::DEPENDENCIES[$name]['class'],
                (self::DEPENDENCIES[$name]['foreign_key'] ?? Str::singular($name) . '_id')
            );
        }

        return parent::__call($name, $arg);
    }
}
