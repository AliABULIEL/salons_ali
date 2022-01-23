<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'price', 'status',  'business_id'
    ];

    public function items()
    {
    	return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function client()
    {
    	return $this->belongsTo(User::class, 'client_id');
    }
}
