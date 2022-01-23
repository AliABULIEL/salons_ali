<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
	use HasTranslations;

    public $translatable = [
        'name', 'description'
    ];

    public function business()
    {
    	return $this->belongsTo(Business::class);
    }

    public function details()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'images' => [$this->image],
            'description' => $this->description,
            'price' => $this->price
        ];
    }
}
