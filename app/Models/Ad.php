<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ad extends Authenticatable implements LaratrustUser, HasMedia

{
    use  HasRolesAndPermissions, InteractsWithMedia;

    protected $table = 'ads';


    protected $fillable = [
        'name',
        'description',
        'status',
        'vendor_id'
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
