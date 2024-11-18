<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Admin extends Authenticatable implements LaratrustUser
{
    use HasFactory, SoftDeletes, HasRolesAndPermissions;

    // Table name (optional, if different from pluralized model name)
    protected $table = 'admins';

    // protected $guarded = 'admins';

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
        'deleted_at'
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
}
