<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, InteractsWithMedia ,Translatable;

    protected $table = 'services';
    public $translatedAttributes  = ['name'];
    protected $fillable = ['parent_id'];
    protected $with=['translations'];


    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_id');
    }







    // Translate the service name based on the locale
    public function getNameAttribute($value)
    {
        return $this->translate('en')->name ?? $this->translate('ar')->name ?? $value;
    }
}

