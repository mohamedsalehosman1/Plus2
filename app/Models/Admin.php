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
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\ResetPasswordNotification;

class Admin extends Authenticatable implements LaratrustUser, HasMedia, CanResetPassword
{
    use HasFactory, SoftDeletes, HasRolesAndPermissions, InteractsWithMedia, Notifiable;

    protected $table = 'admins';


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
    protected $hidden = [
        'password',
        'remember_token',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
        'blocked_at' => 'datetime',
        'last_login_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
    }
    public function sendPasswordResetNotification($token)
    {
        $url = url('/reset-password/'.$token);
        // $this->notify(new ResetPasswordNotification($url));
    }
}
