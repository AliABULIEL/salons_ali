<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderUpdated;
use App\Notifications\OrderApproved;
use App\Notifications\OrderCanceled;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\Service;
use App\User;
use Auth;

/**
 * @group Orders
 */
class OrdersController extends Controller
{
    /**
     * Get active orders 
     *
     * Get user's orders (active) by business ID.
     * @bodyParam business_id integer required business ID. Example: 1
     * @authenticated
     * @response {
     *    "orders": [
     *     ]
     * }
    **/
    public function active(Request $request)
    {
        $orders = Order::with('user', 'business', 'client')
                    ->has('user')
                    ->where('approved', true)
                    ->where('canceled', false)
                    ->where('business_id', $request->business_id)
                    ->where('starting_at', '>=', Carbon::now());
                    

        if ($request->user()->role == 'Business employee') 
            $orders = $orders->where('user_id', $request->user()->id);

        if ($request->user()->role == 'Business client')
            $orders = $orders->where('client_id', $request->user()->id);


        $orders = $orders->get()->map(function($order) {
                        return $order->details();
                    });

        return [
            'orders' => $orders
        ];
    }

    /**
     * Get archived orders 
     *
     * Get user's orders (archived) by business ID.
     * @bodyParam business_id integer required business ID. Example: 1
     * @authenticated
     * @response {
     *    "orders": [
     *     ]
     * }
    **/
    public function archived(Request $request)
    {
        $orders = Order::with('user', 'business', 'client')
                    ->has('user')
                    ->where('business_id', $request->business_id)
                    ->where(function (Builder $query) use ($request) {
                        return $query->whereDate('starting_at', '<', Carbon::now())
                                     ->orWhere('canceled', true);
                    });


        if ($request->user()->role == 'Business employee') 
            $orders = $orders->where('user_id', $request->user()->id);

        if ($request->user()->role == 'Business client') 
            $orders = $orders->where('client_id', $request->user()->id);


        $orders = $orders->get()->map(function($order) {
                        return $order->details();
                    });

        return [
            'orders' => $orders
        ];
    }

    /**
     * Get waiting approval orders 
     *
     * Get user's order (waiting approval) orders by business ID.
     * @bodyParam business_id integer required business ID. Example: 1
     * @authenticated
     * @response {
     *    "orders": [
     *     ]
     * }
    **/
    public function waitingApproval(Request $request)
    {
        $orders = Order::with('user', 'business', 'client')
                    ->has('user')
                    ->whereDate('starting_at', '>=', Carbon::now())
                    ->where('canceled', false)
                    ->where('business_id', $request->business_id)
                    ->where('should_approved', true)
                    ->where('approved', false);

        if ($request->user()->role == 'Business employee') 
            $orders = $orders->where('user_id', $request->user()->id);

        if ($request->user()->role == 'Business client') 
            $orders = $orders->where('client_id', $request->user()->id);


        $orders = $orders->get()->map(function($order) {
                        return $order->details();
                    });

        return [
            'orders' => $orders,
        ];
    }

    /**
     * Get order by ID
     *
     * Get order by ID
     * @authenticated
    **/
    public function getOrder($id, Request $request)
    {
        $order = Order::where('id', $id)
                    ->firstOrFail();


        if ($this->checkRole($order)) return [
            'message' => 'No permission',
        ];


        $services = Service::whereIn('id', $order->services)->get();

        $employee = $order->user;

        $date = $order->starting_at;

        $time = [
            'start' => $order->start_at,
            'end' => $order->end_at,
            'disabled' => true,
        ];

        return [
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


    /**
     * Update order by ID
     *
     * Send time that neede to be appointed
     * @authenticated
     * @bodyParam services_id int[] required services ids.  Example: [1,2]
     * @bodyParam employee_id int required employee id.  Example: 1
     * @bodyParam date string required order date.  Example: 2021-02-01
     * @bodyParam time string required order time.  Example: 10:00
    **/
    public function updateOrder($id, Request $request)
    {
        $order = Order::where('id', $id)
                    ->firstOrFail();


        if ($this->checkRole($order)) return [
            'message' => 'No permission',
        ];


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



        $order->update([
            //'user_id' => $employee->id,
            //'client_id' => $request->user()->id,
            'business_id' => $employee->business_id,
            'services' => $services->pluck('id'),
            'total' => $services->sum('price'),
            'minutes' => $services->sum('minutes'),
            'starting_at' => $date->toDateTimeString(),
            'ending_at' => $date->clone()->addMinutes($services->sum('minutes'))->toDateTimeString(),
            'should_approved' => $shouldApproved,
        ]);


        $users = User::whereIn('role', ['Admin', 'Business admin'])->get();
        $users[] = $order->user;
        $users[] = $order->client;
        
        Notification::send(collect($users)->unique(), new OrderUpdated($order));

        return [
            'status' => 'Order updated successfully',
            'services' => $services->map->details(),
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


    public function getEmployeesHasSeriveces()
    {
        return User::whereHas('services', function($service) {
            return $service->where('clients_count', '>=', 1);
        })
        ->where('role', '!=', 'Business client');
    }


    /**
     * Cancel order by ID
     *
     * Cancel order by ID
     * @authenticated
    **/
    public function cancelOrder($id, Request $request)
    {
        $order = Order::where('id', $id)
                    ->firstOrFail();

        $order->update([
            'canceled' => true
        ]);

        $users = User::whereIn('role', ['Admin', 'Business admin'])->get();
        $users[] = $order->user;
        $users[] = $order->client;

        Notification::send(collect($users)->unique(), new OrderCanceled($order));

        return [
            'message' => 'Order canceled',
            'order' => $order->details()
        ];
    }


    /**
     * Approve order by ID
     *
     * Approve order by ID
     * @authenticated
    **/
    public function approveOrder($id, Request $request)
    {
        $order = Order::where('id', $id)
                    ->firstOrFail();

        $order->update(['approved' => true]);

        $users = User::whereIn('role', ['Admin', 'Business admin'])->get();
        $users[] = $order->user;
        $users[] = $order->client;
        
        Notification::send(collect($users)->unique(), new OrderApproved($order));

        return [
            'message' => 'Order approved',
            'order' => $order->details()
        ];
    }


    public function checkRole($order)
    {
        if (
            $order->user_id != Auth::id() || 
            $order->client_id != Auth::id() || 
            Auth::user()->role != 'Business admin' || 
            Auth::user()->role != 'Admin'
        ){
            return false;
        }
    }

    public function generateDays($employee, $start = null, $end = null)
    {
        if (! $start) $start = Carbon::today()->addDays(1);
        if (! $end) $end = Carbon::today()->addDays(10);


        $days = collect([]);

        while ($start <= $end) {
            $working =  $employee->opening_hours->where('day_name', $start->englishDayOfWeek);

            if($working->count() > 0)
                $days->push([
                    'date' => $start->clone()->format('Y-m-d'),
                    'name' => $start->englishDayOfWeek,
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
