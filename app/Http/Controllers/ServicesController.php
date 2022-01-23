<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

/**
 * @group Services
 */
class ServicesController extends Controller
{
    /**
     * Get services list
     *
     * Get services by business ID.
     * @bodyParam business_id integer required business ID. Example: 1
     * @response {
     *    "services": [
     *     ]
     * }
    **/
    public function get(Request $request)
    {
        $services = Service::where('active', true)
                    ->where('business_id', $request->business_id)
        			->get();

        return [
            'services' => $services->map->details(),
        ];
    }

}
