<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetToken extends Model
{
    protected $fillable = [




        'token',

        'email'
    ];

    public function resetable()
    {
        return $this->morphTo();
    }
}
