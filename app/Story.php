<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'image', 'views', 'user_id'
    ];
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function details()
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'user' => [
            	'name' => $this->user->name,
            	'image' => $this->user->image,
            ],
            'views' => $this->views,
        ];
    }
}
