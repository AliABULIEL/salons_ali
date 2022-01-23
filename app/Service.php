<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
	use HasTranslations;

    public $translatable = [
        'name', 'description'
    ];

    public function business()
    {
    	return $this->belongsTo(Business::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function opening_hours()
    {
        return $this->hasMany(OpeningHour::class);
    }

    public function details()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'description' => $this->description,
            'minutes' => $this->minutes,
            'clients_count' => $this->clients_count,
        ];
    }


    public function getClientsRegistredAttribute()
    {
        return Order::whereJsonContains('services', $this->id)->count();
    }

    public function clientsRegistredAtDate($date)
    {
        return Order::whereJsonContains('services', $this->id)->where('starting_at', $date)
                ->count();
    }
}
