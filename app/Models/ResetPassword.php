<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $fillable = [




        'code',

        'email'
    ];

    public function resetable()
    {
        return $this->morphTo();
    }
}
