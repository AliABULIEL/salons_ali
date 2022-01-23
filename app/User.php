<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasTranslations, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'about', 'address', 'working_days', 'phone', 'role', 'api_token', 'fcm_token', 'email', 'password', 'image', 'business_id', 'locale', 'suspended'
    ];


    public $translatable = [
        'first_name', 'last_name', 'about', 'address', 'working_days'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'suspended' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function workshops()
    {
        return $this->belongsToMany(Service::class)->where('clients_count', '>=', 1);
    }

    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, \App::getLocale());
        }
        return $attributes;
    }


    public function getNameAttribute()
    {
        $firstName = $this->first_name != '' ? $this->first_name : $this->getTranslation('first_name', 'en');
        $lastName = $this->last_name != '' ? $this->last_name : $this->getTranslation('last_name', 'en');

        return "{$firstName} {$lastName}";
    }

    public function setNameAttribute($value)
    {
        $words = explode(' ', $value);

        if (count($words) >= 2) {
            [$firstName, $lastName] = $words;

            $this->first_name = $firstName;
            $this->last_name = $lastName;
        }
        
        
        else $this->first_name = $value;
    }

    public function details($public = true)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'role' => $this->role,
            'image' => $this->image,
            'fcm_token' => $public ? $this->fcm_token : null,
            'suspended' => $this->suspended
        ];
    }

    public function detailsWithOrdersCount()
    {
        return array_merge($this->details(), [
            'orders_count' => $this->orders_count
        ]);
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function opening_hours()
    {
        return $this->hasMany(OpeningHour::class);
    }

    public function orders()
    {
        if ($this->role == 'Business client') {
            return $this->hasMany(Order::class, 'client_id');
        }
        else {
            return $this->hasMany(Order::class);
        }
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }

    public function routeNotificationForFcm($notification)
    {
        return $this->fcm_token;
    }

    public function getIsActiveAttribute()
    {
        if ($this->suspended == false) return true;
        return false;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'client_id');
    }
}
