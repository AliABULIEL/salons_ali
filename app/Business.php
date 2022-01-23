<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Business extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'intro', 'about', 'address', 'working_days', 'logo',
        'cover', 'social_links', 'address_text', 'address_image',
        'sms_notifications', 'push_notifications', 'fcm_token'
    ];


    public $translatable = [
    	'name', 'intro', 'about', 'address', 'working_days', 'address_text'
    ];

    public $casts = [
        'social_links' => 'array',
        'sms_notifications' => 'boolean',
        'push_notifications' => 'boolean'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function opening_hours()
    {
    	return $this->hasManyThrough(OpeningHour::class, User::class);
    }

    public function stories()
    {
        return $this->hasManyThrough(Story::class, User::class);
    }

    // public function services()
    // {
    //     return $this->hasManyThrough(Service::class, User::class);
    // }

    public function details()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->primary_color,
            'logo' => $this->logo,
            'cover' => $this->cover,
            'intro' => $this->intro,
            'about' => $this->about,
            'address' => $this->address,
            'address_text' => $this->address_text,
            'address_image' => $this->address_image,
            'working_days' => $this->working_days,
            'social_links' => $this->social_links,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude
        ];
    }
}
