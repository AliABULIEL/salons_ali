<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreated;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Service;
use App\User;
use App\Order;
use Auth;

/**
 * @group Create Order
 */
class CreateOrderController extends Controller
{

    /**
     * Submit services and get employees
     *
     * Submit service and get employees list
     * @authenticated
     * @bodyParam services_id int[] required services ids.  Example: [1,2]
    **/
    public function submitServices(Request $request)
    {
        $requestedServices = Service::whereIn('id', $request->services_id)->get();

        $employees = $this->getEmployeesHaveServices($requestedServices);

        return [
            'employees' => $employees->map->details()
        ];
    }


    /**
     * Submit employee
     *
     * Submit employee and get dates and times that this employee is available
     * @authenticated
     * @bodyParam services_id int[] required services ids.  Example: [1,2]
     * @bodyParam employee_id int required employee id.  Example: 1
    **/
    public function submitEmployee(Request $request)
    {

        $services = Service::whereIn('id', $request->services_id)->get();
        $employees = $this->getEmployeesHaveServices($services);
        $employee = $employees
                        ->whereIn('id', $employees->pluck('id'))
                        ->where('id', $request->employee_id)->first(); 

                        // return $employee->business;
        $from = Carbon::now()->addDays($employee->business->order_min_days);
        $end = $from->clone()->addDays(10);

        return [
            'services' => $services->map->details(),
            'employee' => $employee ? $employee->details() : null,
            'days' => $this->generateDays($employee, $from, $end),
        ];
    }


    /**
     * Submit day
     *
     * Submit day and get available times
     * @authenticated
     * @bodyParam services_id int[] required services ids.  Example: [1,2]
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam date string required order date.  Example: 2021-02-01
    **/
    public function submitDay(Request $request)
    {
        $services = Service::whereIn('id', $request->services_id)->get();
        $employees = $this->getEmployeesHaveServices($services);
        $employee = $employees
                        ->whereIn('id', $employees->pluck('id'))
                        ->where('id', $request->employee_id)->first(); 

        $date = Carbon::parse($request->date);

        $times = $employee->opening_hours
                        ->where('day_name', $date->englishDayOfWeek)
                        ->map
                        ->getAvailableTimes($date, $services)
                        ->flatten(1);



        return [
            'services' => $services->map->details(),
            'employee' => $employee ? $employee->details() : null,
            'date' =>  $date->format('Y-m-d'),
            'day' => $date->englishDayOfWeek,
            'times' => $times 
        ];
    }


    /**
     * Submit time
     *
     * Send time that neede to be appointed
     * @authenticated
     * @bodyParam services_id int[] required services ids.  Example: [1,2]
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam date string required order date.  Example: 2021-02-01
     * @bodyParam time string required order time.  Example: 10:00
    **/
    public function submitTime(Request $request)
    {        
        $services = Service::whereIn('id', $request->services_id)->get();
        $employees = $this->getEmployeesHaveServices($services);
        $employee = $employees
                        ->whereIn('id', $employees->pluck('id'))
                        ->where('id', $request->employee_id)->first(); 

        $date = Carbon::parse($request->date);

        $times = $employee->opening_hours
                        ->where('day_name', $date->englishDayOfWeek)
                        ->map
                        ->getAvailableTimes($date, $services)
                        ->flatten(1);

        $time = $times->where('start', $request->time)
                    ->where('disabled', false)
                    ->first();

        if (!$time) {
            return [
                'message' => 'Time not available'
            ];
        }

        return [
            'services' => $services->map->details(),
            'employee' => $employee ? $employee->details() : null,
            'date' =>  $date->format('Y-m-d'),
            'day' => trans($date->englishDayOfWeek),
            'time' => $time
        ];
    }


    /**
     * Submit order
     *
     * Send time that neede to be appointed
     * @authenticated
     * @bodyParam services_id int[] required services ids.  Example: [1,2]
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam date string required order date.  Example: 2021-02-01
     * @bodyParam time string required order time.  Example: 10:00
     * @bodyParam notes string text notes.  Example: 'this is a note'
     * @bodyParam first_name string User fist name. Example: Jon
     * @bodyParam last_name string User last name.  Example: Snow
     * @bodyParam phone string User phone number.  Example: 0501234567
    **/
    public function submitOrder(Request $request)
    {

        $services = Service::whereIn('id', $request->services_id)->get();

        $shouldApproved = false;

        $services->each(function($service) use (& $shouldApproved) {
            if ($service->should_approved) {
                $shouldApproved = true;
            }
        });

        $employees = $this->getEmployeesHaveServices($services);
        $employee = $employees
                        ->whereIn('id', $employees->pluck('id'))
                        ->where('id', $request->employee_id)->first(); 

        $date = Carbon::parse($request->date . '' . $request->time);

        $times = $employee->opening_hours
                        ->where('day_name', $date->englishDayOfWeek)
                        ->map
                        ->getAvailableTimes($date, $services)
                        ->flatten(1);

        $time = $times->where('start', $request->time)
                    ->where('disabled', false)
                    ->first();

        if (!$time) {
            return [
                'message' => 'Time not available'
            ];
        }


        $client = false;
        if ($request->phone) {
            $client = User::firstOrCreate([
                'phone' => $request->phone,
                'first_name' => $request->fist_name,
                'last_name' => $request->last_name,
            ]);

            $client->update([
                'role' => 'Business client',
                'business_id' => $request->business_id,
                'locale' => app()->getLocale(),
                'suspended' => false,
            ]);
        }


        $order = Order::create([
            'user_id' => $employee->id,
            'client_id' => $client ? $client->id : $request->user()->id,
            'business_id' => $employee->business_id,
            'services' => $services->pluck('id'),
            'total' => $services->sum('price'),
            'minutes' => $services->sum('minutes'),
            'starting_at' => $date->clone()->toDateTimeString(),
            'ending_at' => $date->clone()->addMinutes($services->sum('minutes'))->toDateTimeString(),
            'should_approved' => $shouldApproved,
            'approved' => $shouldApproved ? false : true,
            'canceled' => 0,
            'notes' => $request->notes
        ]);

        $users = User::whereIn('role', ['Admin', 'Business admin'])
                        ->whereNotNull('fcm_token')
                        ->get();
        
        if ($order->user->fcm_token) {
            $users[] = $order->user;
        }
        
        $order->load('client');

        if ($order->client->fcm_token && $order->client->fcm_token != null) {
            $users[] = $order->client;
        }

        Notification::send(collect($users)->unique(), new OrderCreated($order));

        return [
            'status' => 'Order created successfully',
            'services' => $services->map->details(),
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

    public function generateDays($employee, $start = null, $end = null)
    {
        if (! $start) $start = Carbon::today()->addDays(1);
        if (! $end) $end = Carbon::today()->addDays(10);


        $days = collect([]);

        while ($start <= $end) {
            $working =  $employee->opening_hours->where('day_name', $start->englishDayOfWeek);

            if ($working->count() > 0) 
                $days->push([
                    'date' => $start->clone()->format('Y-m-d'),
                    'name' => trans($start->englishDayOfWeek),
                    'disabled' => $working->count() == 0,
                ]);                

            $start->addDay();
        }

        return $days;
    }


    public function getEmployeesHaveServices($services)
    {
        $employees = User::query();
        
        $services->each(function($service) use (& $employees) {
            $employees->whereHas('services', function($employeeService) use ($service){
                $employeeService->where('id', $service->id);
            });
        });

        return $employees->get();
    }
}
