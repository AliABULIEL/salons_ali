<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use Carbon\Carbon;
use Auth;

class Order extends Model
{
    protected $guarded = [];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'starting_at', 
        'ending_at'
    ];

    public $casts = [
        'services' => 'array',
        'should_approved' => 'boolean',
        'approved' => 'boolean',
        'canceled' => 'boolean',
    ];

    public $appends = [
        'start_at',
        'end_at'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function business()
    {
    	return $this->belongsTo(Business::class);
    }

    public function getStartAtAttribute()
    {
        return $this->starting_at->format('H:i');
    }

    public function getEndAtAttribute()
    {
        return $this->ending_at->format('H:i');
    }


    public function isArchived()
    {
        if ($this->starting_at < Carbon::now() || $this->canceled) 
            return true;

        return false;
    }

    public function details()
    {

        $details = [
            'id' => $this->id,
            'business_id' => $this->business_id,
            'name' => $this->name(),
            'services' => $this->services,
            'total' => $this->total,
            'minutes' => $this->minutes,
            'starting_at' => $this->starting_at,
            'ending_at' => $this->ending_at,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'notes' => (Auth::user()->role != 'Business client') ? $this->notes : null,
            'start_date' => $this->starting_at->format('Y-m-d'),
            'start_time' => $this->starting_at->format('H:i'),
            'user_image' => $this->user ? $this->user->image: '',
            'clinet_name' => $this->client ? $this->client->name : '',
            'should_approved' => $this->should_approved,
            'approved' => $this->approved,
            'canceled' => $this->canceled,
            'can_edit' => Carbon::now()->addDays($this->cancel_min_days) < $this->starting_at ? true : false,
            'can_cancel' => Carbon::now()->addDays($this->cancel_min_days) < $this->starting_at ? true : false,
            'can_approve' => ($this->should_approved && $this->approved == false && Auth::user()->role != 'Business client') ? true : false,
        ];

        if ($this->isArchived()) {
            $details['can_edit'] = false;
            $details['can_cancel'] = false;
            $details['can_approve'] = false;
        }

        return $details;
    }


    public function name()
    {
        $names = Service::whereIn('id', $this->services)
                        ->get()
                        ->pluck('name')
                        ->toArray();

        return implode(' و', $names);
    }
}
