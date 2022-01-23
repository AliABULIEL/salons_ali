<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OpeningHour extends Model
{
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getAvailableTimes($date, $services)
    {
        return $this->generateTimes($date, $services->sum('minutes'));
    }

    public function getAvailableTimesSingle($date, $service)
    {
        return $this->generateServiceTimes($date, $service->minutes);
    }

    public function generateDays($selectedServices, $start, $end)
    {
    	$days = collect([]);
    	$distance = $selectedServices->sum('minutes');

    	while ($start <= $end) {
    		$days->push([
    			'date' => $start->clone()->format('Y-m-d'),
    			'name' => $start->englishDayOfWeek,
    			'times' => $this->generateTimes($start, $distance)
    		]);

    		$start->addDay();
    	}

    	return $days;
    }

    public function generateTimes($date, $distance)
    {
    	$times = collect([]);

    	$startTime = Carbon::parse($this->opening_at);
        $endTime = Carbon::parse($this->closing_at);

        $start = $date->clone()
                    ->hour($startTime->hour)
                    ->minute($startTime->minute);


        $end = $date->clone()
                    ->hour($endTime->hour)
                    ->minute($endTime->minute);

    	
        $now = date('Y-m-d H:i');

    	while ($start <= $end) {
            $from = $start->clone();
            $to = $start->clone()->addMinutes($distance);

            if (!$this->hasOrdersBetween($from, $to) && $from > $now) {
                $times->push([
                    'start' => $from->clone()->format('H:i'),
                    'end' => $to->clone()->format('H:i'),
                    'disabled' => false
                ]);
            }

            $start->addMinutes($distance);
    	}

    	return $times;
    }

    public function generateServiceTimes($date, $distance)
    {
        $times = collect([]);

        $startTime = Carbon::parse($this->opening_at);
        $endTime = Carbon::parse($this->closing_at);

        $start = $date->clone()
                    ->hour($startTime->hour)
                    ->minute($startTime->minute); 

        $end = $date->clone()
                    ->hour($endTime->hour)
                    ->minute($endTime->minute);
        
        $now = date('Y-m-d H:i');

        while ($start < $end) {
            $from = $start->clone();
            $to = $start->clone()->addMinutes($distance);

            if ($from > $now ) {
                $times->push([
                    'start' => $from->clone()->format('H:i'),
                    'end' => $to->clone()->format('H:i'),
                    // 'disabled' => $this->service->clients_registred >= $this->service->clients_count,
                    'clients_count' => $this->service->clients_count,
                    // 'clients_registred' => $this->service->clients_registred,
                    'clients_registred' => $this->service->clientsRegistredAtDate($start->clone()->format('Y-m-d')),
                    'disabled' =>  $this->service->clientsRegistredAtDate($start->clone()->format('Y-m-d')) >= $this->service->clients_count,
                ]);
            }

            $start->addMinutes($distance);
        }

        return $times;
    }

    public function getWrokshopOrders()
    {
        return [];
    }

    public function hasOrdersBetween($start, $end)
    {

        $orders = $this->user->orders()
                        ->where(function($query) use ($start, $end) {
                            return $query->where('canceled', false)
                                        ->where('starting_at', '>=', $start)
                                        ->where('starting_at', '<', $end); 
                        })
                        ->orWhere(function($query) use ($start, $end) {
                            return $query->where('canceled', false)
                                        ->where('ending_at', '>', $start)
                                        ->where('ending_at', '<=', $end);
                        })
                        ->orWhere(function($query) use ($start, $end) {
                            return $query->where('canceled', false)
                                        ->where('starting_at', '<', $start)
                                        ->where('ending_at', '>', $end);
                        })
                        ->get();

        return (boolean) $orders->count();
    }
}
