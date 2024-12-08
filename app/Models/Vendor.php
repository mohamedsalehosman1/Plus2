<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vendor extends Authenticatable implements LaratrustUser, HasMedia
{
    use HasFactory, SoftDeletes, HasRolesAndPermissions;
    use InteractsWithMedia;

    // Table name (optional, if different from pluralized model name)
    protected $table = 'vendors';

    // protected $guarded = 'Vendors';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'preferred_locale',
        'blocked_at',
        'last_login_at',
        'email_verified_at',
        'phone_verified_at',
        'deleted_at',
        'service_id',
    ];

    // Timestamps for created_at and updated_at are enabled by default, but we specify them explicitly if needed
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Define the attributes that should be cast to native types
    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
        'blocked_at' => 'datetime',
        'last_login_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
