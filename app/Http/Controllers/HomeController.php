<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;

/**
 * @group Home
 */
class HomeController extends Controller
{

    /**
     * Get Home data
     *
     * Get home data by business ID.
     * @bodyParam business_id integer required business ID. Example: 1
     * @response {
     *    "business": {
     *        "id": 1,
     *        "name": "صالون الزعيم",
     *        "intro": "اهلا بك في صالون الزعيم",
     *        "about": "",
     *        "address": "Nazareth",
     *        "working_days": "كل الايام",
     *        "logo": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
     *        "cover": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
     *        "primary_color": "#E91E63",
     *        "social_links": [],
     *        "order_min_days": 0,
     *        "user_id": null,
     *        "created_at": "2021-01-22T00:39:20.000000Z",
     *        "updated_at": "2021-01-22T00:39:47.000000Z"
     *     },
     *     "stories": [],
     *     "show_notifications": true,
     * }
    **/
    public function get(Request $request)
    {
        $business = Business::findOrFail($request->business_id);

        $stories = $business->stories()
                        ->with('user')
                        ->orderBy('id', 'desc')
                        ->take(30)
                        ->get();

        return [
            'business' => $business->details(),
            'stories' => $stories->map->details(),
            'show_notifications' => true
        ];
    }
}
