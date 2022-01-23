<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;

/**
 * @group Products
 */
class ProductsController extends Controller
{
    /**
     * List
     *
     * Get Products by business ID.
     * @bodyParam business_id integer required business ID. Example: 1
     * @response {
     *  "products": [
     *      {
     *          "id": 1,
     *          "name": 'product name',
     *          "image": "uJZoX5RTsWHGwZfkL7DmaFI2y7rb6fi4UgdadqtP.jpg",
     *          "price": 10,
     *          "created_at": "2021-01-26T09:49:43.000000Z",
     *          "updated_at": "2021-01-26T09:49:43.000000Z"
     *      }
     *  ]
     * }
    **/
	public function list(Request $request)
	{
        $business = Business::findOrFail($request->business_id);

        $products = $business->products()
                        ->orderBy('id', 'desc')
                        ->take(30)
                        ->get();

		return [
            'products' => $products->map->details() //$stories->map->details()
        ];
    }
}
