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
    use HasFactory, InteractsWithMedia;
    use Translatable;

    protected $table = 'services';
    protected $primarykey = 'id';

    protected $fillable = ['name:ar', 'name:en',  'parent_id'];

    public $translatedAttributes = ['name'];
    protected $guarded = [];


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

