<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneCode extends Model
{
    protected $fillable = [
        'phone', 'code', 'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];
}
