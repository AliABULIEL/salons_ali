<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Client;
use App\Business;
use App\Order;
use Auth;

/**
 * @group User
 */
class UsersController extends Controller
{
    /**
     * Show
     *
     * Get logged in user.
     * @authenticated
     * @response {
     *     "id": 1,
     *     "first_name": "Jon",
     *     "last_name": "Snow",
     *     "phone": "050123456",
     *     "role": "Client"
     * }
    **/
	public function show(Request $request)
	{
		return $request->user()->details();
	}

    /**
     * Update
     *
     * Update logged in user.
     * @authenticated
     * @bodyParam first_name string User fist name. Example: Jon
     * @bodyParam last_name string User last name. Example: Snow
     * @bodyParam phone string User phone number. Example: 0501234567
     * @bodyParam fcm_token string User FCM token. Example: YOUR_FCM_TOKEN
     * @bodyParam image string Image path. Example: 'khgs87l28xnslw8dshewl3udhswl.jpg'
     * @response {
     *     "id": 1,
     *     "first_name": "Jon",
     *     "last_name": "Snow",
     *     "phone": "050123456",
     *     "role": "Client"
     * }
    **/
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'first_name' => 'min:2',
            'last_name' => 'min:2',
            'phone' => [
                Rule::unique('users')->ignore($user->id)
            ],
            'fcm_token' => '',
            'image' => '',
        ]);

        if ($request->first_name) {
            $user->first_name = $request->first_name;
        }
        if ($request->last_name) {
            $user->last_name = $request->last_name;
        }
        if ($request->phone) {
            $user->phone = $request->phone;
        }
        if ($request->fcm_token) {
            $user->fcm_token = $request->fcm_token;
        }
        if ($request->image) {
            $user->image = $request->image;
        }

        $user->locale = app()->getLocale();
        $user->save();
        
        return $request->user()->details();
    }
}
