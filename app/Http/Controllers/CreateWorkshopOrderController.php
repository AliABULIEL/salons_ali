<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Service;
use Carbon\Carbon;
use App\Order;

/**
 * @group Create Workshop Order
 */
class CreateWorkshopOrderController extends Controller
{
    /**
     * Get Employees
     *
     * @authenticated
    **/
    public function getEmployees(Request $request)
    {        
        $employees = $this->getEmployeesHasSeriveces()->get();

        return [
            'employees' => $employees->map->details(false)
        ];
    }

    public function getEmployeesHasSeriveces()
    {
    	return User::whereHas('services', function($service) {
    		return $service->where('clients_count', '>=', 1);
    	})
    	->where('role', '!=', 'Business client');
    }

    /**
     * Submit Employee and get workshops
     *
     * Submit employees and get workshops list
     * @authenticated
     * @bodyParam employee_id int required employee id.  Example: 1
    **/
    public function submitEmployee(Request $request)
    {
        $employee = $this->getEmployeesHasSeriveces()
        						->where('id', $request->employee_id)->first();

        if(!$employee) return ['message' => 'Employee not found'];

        $workshops = $employee->workshops()->get();

        return [
        	'employee' => $employee->details(false),
            'workshops' => $workshops->map->details()
        ];
    }

    /**
     * Submit Workshop and get days
     *
     * Submit employees and get workshops list
     * @authenticated
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam workshop_id int required employee id.  Example: 1
    **/
    public function submitWorkshop(Request $request)
    {
        $employee = $this->getEmployeesHasSeriveces()
        						->where('id', $request->employee_id)->first();


        if(!$employee) return ['message' => 'Employee not found'];

        $workshop = $employee->workshops()->where('id', $request->workshop_id)->first();
        
        if(! $workshop) return ['message' => 'Workshop not found'];

        $from = Carbon::now()->addDays($employee->business->order_min_days ?? 1);
        $end = $from->clone()->addDays(10);

        return [
        	'employee' => $employee->details(false),
            'workshop' => $workshop,
            'days' => $this->generateDays($workshop, $from, $end),
        ];
    }

    /**
     * Submit day
     *
     * Submit day and get available times
     * @authenticated
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam workshop_id int required employee id.  Example: 1
     * @bodyParam date string required order date.  Example: 2021-02-01
    **/
    public function submitDay(Request $request)
    {
        $employee = $this->getEmployeesHasSeriveces()
        						->where('id', $request->employee_id)->first();

        $workshop = $employee->workshops()->with('opening_hours')->where('id', $request->workshop_id)->first();

        $date = Carbon::parse($request->date);

        $times = $workshop->opening_hours
                        ->where('day_name', $date->englishDayOfWeek)
                        ->map
                        ->getAvailableTimesSingle($date, $workshop)
                        ->flatten(1);

        return [
            'workshop' => $workshop->details(),
            'employee' => $employee ? $employee->details() : null,
            'date' =>  $date->format('Y-m-d'),
            'day' => $date->englishDayOfWeek,
            'times' => $times,
        ];
    }

    /**
     * Submit time
     *
     * Send time that neede to be appointed
     * @authenticated
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam workshop_id int required employee id.  Example: 1
     * @bodyParam date string required order date.  Example: 2021-02-01
     * @bodyParam time string required order time.  Example: 10:00
    **/
    public function submitTime(Request $request)
    {        
        $employee = $this->getEmployeesHasSeriveces()
        						->where('id', $request->employee_id)->first();

        $workshop = $employee->workshops()->where('id', $request->workshop_id)->first();

        // return $workshop;

        $date = Carbon::parse($request->date);

        $times = $workshop->load('opening_hours')->opening_hours
                        ->where('day_name', $date->englishDayOfWeek)
                        ->map
                        ->getAvailableTimesSingle($date, $workshop)
                        ->flatten(1);


        $time = $times->where('start', $request->time)
                    // ->where('disabled', false)
                    ->first();

        if (!$time) {
            return [
                'message' => 'Time not available'
            ];
        }

        if($time['disabled'] == true) {
        	return [
                'message' => 'Max clients'
            ];
        }

        return [
            'workshop' => $workshop->details(),
            'employee' => $employee ? $employee->details() : null,
            'date' =>  $date->format('Y-m-d'),
            'day' => $date->englishDayOfWeek,
            'time' => $time
        ];
    }

    /**
     * Submit workshop order
     *
     * Submit workshop order
     * @authenticated
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam workshop_id int required employee id.  Example: 1
     * @bodyParam date string required order date.  Example: 2021-02-01
     * @bodyParam time string required order time.  Example: 10:00
     * @bodyParam notes string text notes.  Example: 'this is a note'
     * @bodyParam first_name string User fist name. Example: Jon
     * @bodyParam last_name string User last name.  Example: Snow
     * @bodyParam phone string User phone number.  Example: 0501234567
    **/
    public function submitOrder(Request $request)
    {
        $employee = $this->getEmployeesHasSeriveces()
                                ->where('id', $request->employee_id)->first();

        $workshop = $employee->workshops()->where('id', $request->workshop_id)->first();

        $date = Carbon::parse($request->date);

        $times = $workshop->load('opening_hours')->opening_hours
                        ->where('day_name', $date->englishDayOfWeek)
                        ->map
                        ->getAvailableTimesSingle($date, $workshop)
                        ->flatten(1);


        $time = $times->where('start', $request->time)
                    // ->where('disabled', false)
                    ->first();

        if (!$time) {
            return [
                'message' => 'Time not available'
            ];
        }

        if($time['disabled'] == true) {
            return [
                'message' => 'Max clients'
            ];
        }

        $order = Order::create([
            'user_id' => $employee->id,
            'client_id' => $request->user()->id,
            'business_id' => $workshop->business_id,
            'services' => [$workshop->id],
            'total' => $workshop->price,
            'minutes' => $workshop->minutes,
            'starting_at' => $date->clone()->toDateTimeString(),
            'ending_at' => $date->clone()->addMinutes($workshop->minutes)->toDateTimeString(),
            'should_approved' => $workshop->should_approved,
            'approved' => $workshop->should_approved ? false : true,
            'canceled' => 0,
            'notes' => $request->notes
        ]);

        $users = User::whereIn('role', ['Admin', 'Business admin'])->get();
        $users[] = $order->user;
        $users[] = $order->client;

        // Notification::send(collect($users)->unique(), new OrderCreated($order));

        return [
            'status' => 'Order created successfully',
            'workshop' => $workshop->details(),
            'employee' => $employee ? $employee->details() : null,
            'date' =>  $date->format('Y-m-d'),
            'day' => trans($date->englishDayOfWeek),
            'time' => $time,
            'order' => $order->details(),
            'client' => [
                'name' => $order->client->name,
                'phone' => $order->client->phone
            ]
        ];
    }

    public function generateDays($workshop, $start = null, $end = null)
    {
        if (! $start) $start = Carbon::today()->addDays(1);
        if (! $end) $end = Carbon::today()->addDays(10);

        $days = collect([]);

        while ($start <= $end) {
            $working =  $workshop->opening_hours->where('day_name', $start->englishDayOfWeek);

            //check if there is 

            if ($working->count() > 0) 
                $days->push([
                    'date' => $start->clone()->format('Y-m-d'),
                    'name' => trans($start->englishDayOfWeek),
                    'clients_count' => $workshop->clients_count,
                    'clients_registred' => $workshop->clientsRegistredAtDate($start->clone()->format('Y-m-d')),
                    'disabled' =>  $workshop->clientsRegistredAtDate($start->clone()->format('Y-m-d')) >= $workshop->clients_count,
                ]);                

            $start->addDay();
        }

        return $days;
    }



    /**
     * Update workshop order by ID
     *
     * Send time that neede to be appointed
     * @authenticated
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam workshop_id int required employee id.  Example: 1
     * @bodyParam date string required order date.  Example: 2021-02-01
     * @bodyParam time string required order time.  Example: 10:00
    **/
    public function updateWorkshopOrder($id, Request $request)
    {
        $order = Order::where('id', $id)
                    ->firstOrFail();


        if ($this->checkRole($order)) return [
            'message' => 'No permission',
        ];


        $employee = $this->getEmployeesHasSeriveces()
                                ->where('id', $request->employee_id)->first();

        $workshop = $employee->workshops()->where('id', $request->workshop_id)->first();

        $date = Carbon::parse($request->date);

        $times = $workshop->load('opening_hours')->opening_hours
                        ->where('day_name', $date->englishDayOfWeek)
                        ->map
                        ->getAvailableTimesSingle($date, $workshop)
                        ->flatten(1);


        $time = $times->where('start', $request->time)
                    // ->where('disabled', false)
                    ->first();

        if (!$time) {
            return [
                'message' => 'Time not available'
            ];
        }

        if($time['disabled'] == true) {
            return [
                'message' => 'Max clients'
            ];
        }

        $order->update([
            'business_id' => $employee->business_id,
            'services' => [$workshop->id],
            'total' => $workshop->price,
            'minutes' => $workshop->minutes,
            'starting_at' => $date->toDateTimeString(),
            'ending_at' => $date->clone()->addMinutes($workshop->minutes)->toDateTimeString(),
            'should_approved' => $workshop->shouldApproved,
        ]);

        $users = User::whereIn('role', ['Admin', 'Business admin'])->get();
        $users[] = $order->user;
        $users[] = $order->client;
        
        Notification::send(collect($users)->unique(), new OrderUpdated($order));

        return [
            'status' => 'Order updated successfully',
            'workshop' => $workshop->details(),
            'employee' => $employee ? $employee->details() : null,
            'date' =>  $date->format('Y-m-d'),
            'day' => $date->englishDayOfWeek,
            'time' => $time,
            'order' => $order->details(),
            'client' => [
                'name' => $order->client->name,
                'phone' => $order->client->phone
            ]
        ];
    }
}
