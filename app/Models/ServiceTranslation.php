<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['service_id', 'locale', 'name'];
    public function translations()
{
    return $this->hasMany(ServiceTranslation::class);
}

}
