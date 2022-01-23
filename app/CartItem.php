<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id', 'product_id'
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
