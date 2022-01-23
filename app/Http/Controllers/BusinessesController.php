<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use Validator;
/**
 * @group Businesses
 */
class BusinessesController extends Controller
{

    /**
     * Get
     *
     * Get business by ID.
     * @urlParam id required The ID of the business. Example: 1
     * @response {
	 *    "business": {
	 *        "id": 1,
	 *        "name": "صالون الزعيم",
	 *        "intro": "اهلا بك في صالون الزعيم",
	 *        "about": "",
	 *        "address": "Nazareth",
	 *        "working_days": "",
	 *        "logo": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
	 *        "cover": null,
	 *        "primary_color": "#E91E63",
	 *        "social_links": null,
	 *        "order_min_days": 0,
	 *        "user_id": null,
	 *        "created_at": "2021-01-22T00:39:20.000000Z",
	 *        "updated_at": "2021-01-22T00:39:47.000000Z"
     *	   }
     * }
    **/
    public function get($id, Request $request)
    {
    	$business = Business::findOrFail($id);

    	return [
    		'business' => $business->details()
    	];
	}


    /**
     * Update
     *
     * Update business by ID.
     * @authenticated
     * @urlParam id required The ID of the business. Example: 1
     * @bodyParam name string Example: myname
     * @bodyParam intro string Example: my intro
     * @bodyParam about string Example: my about
     * @bodyParam address string Example: haifa
     * @bodyParam working_days string Example: all days
     * @bodyParam logo string Example: 8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg
     * @bodyParam cover string Example: 8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg
     * @bodyParam facebook string Example: https://facebook.com/username
     * @bodyParam whatsapp string Example: https://whatsapp.com/username
     * @bodyParam instagram string Example: https://instagram.com/username
     * @bodyParam website string Example: https://website.com/username
     * @response {
	 * 	 "message": "Business updated successfully",
	 *   "business": {
	 *       "id": 1,
	 *       "name": "صالون الزعيم",
	 *       "intro": "اهلا بك في صالون الزعيم",
	 *       "about": "",
	 *       "address": "Nazareth",
	 *       "working_days": "",
	 *       "logo": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
	 *       "cover": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
	 *       "created_at": "2021-01-22T00:39:20.000000Z",
	 *       "updated_at": "2021-01-22T00:39:47.000000Z"
	 *   }
     * }
    **/
	public function update($business_id, Request $request)
	{
        if($request->user()->role == 'Business client'){
            return [
                'message' => 'You have no permission'
            ];
        }

		if($request->user()->role == 'Business admin' && $request->user()->business_id != $business_id){
			return [
				'message' => 'You have no permission'
			];
		}

		$business = Business::findOrFail($business_id);

        $data = $request->validate([
            'name' => '',
            'intro' => '',
            'about' => '',
            'address' => '',
            'working_days' => '',
            'logo' => '',
            'cover' => '',
            'facebook' => '',
            'whatsapp' => '',
            'instagram' => '',
            'website' => '',
		]);
		
        $socialLinks = [];

		if ($request->name) 
            $business->name = $request->name;
        
        if ($request->intro) 
            $business->intro = $request->intro;

        if ($request->about) 
            $business->about = $request->about;

        if ($request->address)
            $business->address = $request->address;
        
        if ($request->working_days)
            $business->working_days = $request->working_days;
        
        if ($request->logo)
            $business->logo = $request->logo;

        if ($request->cover)
            $business->cover = $request->cover;

        // if ($request->facebook)
        //     $socialLinks['facebook'] = $request->facebook;

        // if ($request->whatsapp)
        //     $socialLinks['whatsapp'] = $request->whatsapp;

        // if ($request->instagram)
        //     $socialLinks['instagram'] = $request->instagram;

        // if ($request->website)
        //     $socialLinks['website'] = $request->website;

        // if ($request->fcm_token)
        //     $business->fcm_token = $request->fcm_token;
        
        // $business->social_links = $socialLinks;

		$business->save();

		return [
			'message' => 'Business updated successfully',
			'business' => $business->details()
		];

	}

    /**
     * Clients
     *
     * Get business clients.
     * @authenticated
     * @urlParam id required The ID of the business. Example: 1
     * @bodyParam order_by string 'top_orders' or 'latest'. Example: latest
     * @response {
     *   "clients": []
     * }
    **/
    public function clients($business_id, Request $request)
    {
        if($request->user()->role == 'Business client'){
            return [
                'message' => 'You have no permission'
            ];
        }

        if($request->user()->business_id != $business_id){
            return [
                'message' => 'You have no permission'
            ];
        }

        $type = $request->order_by ?? 'top_orders';

        $business = Business::findOrFail($business_id);

        $clients = $business->users()
                            ->withCount('orders')
                            ->where('role', 'Business client');

        if ($type == 'top_orders') {
            $clients = $clients->get()
                               ->map
                               ->detailsWithOrdersCount();

            $clients = $clients->sortByDesc('orders_count')->values();
        }

        else if ($type == 'latest') {
            $clients = $clients->orderBy('created_at', 'desc')
                                ->get()
                                ->map
                                ->detailsWithOrdersCount();
        }

        return [
            'users' => $clients,
        ];
    }

    /**
     * Suspend Client
     *
     * Suspend business clients.
     * @authenticated
     * @urlParam id required The ID of the business. Example: 1
     * @bodyParam user_id integer. Example: 1
     * @response {
     *   "message": "Client suspended successfully"
     * }
    **/
    public function suspendClient($business_id, Request $request)
    {
        if($request->user()->role == 'Business client'){
            return [
                'message' => 'You have no permission'
            ];
        }

        if($request->user()->business_id != $business_id){
            return [
                'message' => 'You have no permission'
            ];
        }

        $business = Business::findOrFail($business_id);

        $client = $business->users()
                            ->where('id', $request->user_id)
                            ->get()
                            ->first();

        if ($client) {
            $client->update([
                'suspended' => true
            ]);

            return [
                'message' => 'Client suspended successfully',
            ];
        }

        return [
            'message' => 'Client not found, id:' .  $request->user_id,
        ];
    }


    /**
     * Unsuspend Client
     *
     * Suspend business clients.
     * @authenticated
     * @urlParam id required The ID of the business. Example: 1
     * @bodyParam user_id integer. Example: 1
     * @response {
     *   "message": "You have no permission"
     * }
    **/
    public function unsuspendClient($business_id, Request $request)
    {
        if($request->user()->role == 'Business client'){
            return [
                'message' => 'You have no permission'
            ];
        }

        if($request->user()->business_id != $business_id){
            return [
                'message' => 'You have no permission'
            ];
        }

        $business = Business::findOrFail($business_id);

        $client = $business->users()
                            ->where('id', $request->user_id)
                            ->get()
                            ->first();

        if ($client) {
            $client->update([
                'suspended' => false
            ]);

            return [
                'message' => 'Client unsuspended successfully',
            ];
        }

        return [
            'message' => 'Client not found, id:' .  $request->user_id,
        ];
    }



	private function handleFileStore($newfile, $currentfile)
	{
		$filepath = storage_path($currentfile);
		if(\File::exists($filepath))
			$filepath->delete();

		return $newfile->store('public');
	}
}
