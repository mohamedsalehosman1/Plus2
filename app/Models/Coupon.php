<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Coupon extends Authenticatable implements LaratrustUser
{

    use HasFactory,  HasRolesAndPermissions;
    protected $table = 'coupons';

    protected $fillable = ['code', 'discount_percent', 'max_discount', 'start_at', 'end_at', 'max_use', 'max_use_per_user', 'is_active', 'vendor_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',

    ];
}
