<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Symfony\Component\String\Slugger\SluggerInterface;

class Coupon extends Authenticatable implements LaratrustUser
{

    use HasFactory,  HasRolesAndPermissions;
    // use HasSlug;
    // public function getSlugOptions()
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('name')
        //    ->saveSlugsTo('slug')->usingspertaor('_');
    // }

    // /**
    //  * Get the route key for the model.
    //  *
    //  * @return string
    //  */
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
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
