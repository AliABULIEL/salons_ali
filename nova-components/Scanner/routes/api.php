<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Notifications\OrderApproved;
use App\Order;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

Route::post('/scan', function (Request $request) {
	$order = Order::where('code', $request->code)->first();


	if (!$order) {
	    return [ 
	    	'status' => 'error',
	    	'message' => 'Invalid Code', 
	    ];
	}

	if ($order->discount->business->user_id != $request->user()->id && $request->user()->role != 'Admin') {
	    return [ 
	    	'status' => 'error',
	    	'message' => 'Invalid Code 1',
	    ];
	}

	if ($order->status == 'Declined') {
	    return [ 
	    	'status' => 'error',
	    	'message' => 'This order declined', 
	    ];
	}

	if ($order) {
		$order->update([
			'status' => 'Approved',
		]);

		$order->user->notify(new OrderApproved($order));

		return [
			'status' => 'success',
			'message' => 'Discount Approved',
		];
	}

    return [ 
    	'status' => 'error',
    	'message' => 'Invalid Code', 
    ];
});
