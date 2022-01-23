<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @group Cart
 */
class CartController extends Controller
{

    /**
     * Get Cart content
     *
     * Get Cart content.
     * @authenticated
     * @response {
	 *   "cart": []
     * }
    **/
    public function getCart(Request $request)
    {
    	$cart = $request->user()->carts()->withCount('items')->firstOrCreate([
    		'business_id' => $request->user()->business_id,
    		'status' => ''
    	]);

    	$items = $cart->items()
    					->with('product')
    					->selectRaw('product_id, count(*) as quantity')
				        ->groupBy('product_id')
				        ->get();

		$items = $items->map(function($item) {
			$product = $item->product->details();

			// return $product;

			return [
				'id' => $item->product_id,
				'quantity' => $item->quantity,
				'name' => $product['name'],
				'image' => $product['image'],
				'description' => $product['description'],
				'price' => $product['price'],
			];
		});

    	return [
    		'id' => $cart->id,
    		'status' => $cart->status,
    		'items_count' => $cart->items_count,
    		'items' => $items,
    	];
    }

    /**
     * Add product to Cart
     *
     * Add product to Cart.
     * @authenticated
     * @bodyParam product_id required The ID of the product. Example: 1
     * @response {
	 *   "cart": []
     * }
    **/
    public function addToCart(Request $request)
    {
    	$cart = $request->user()->carts()->firstOrCreate([
    		'business_id' => $request->user()->business_id,
    		'status' => '',
    	]);

    	$item = $cart->items()->create([
			'product_id' => $request->product_id
    	]);

    	return $this->getCart($request);
    }

    /**
     * Remove product from Cart
     *
     * Remove product from Cart.
     * @authenticated
     * @bodyParam product_id required The ID of the product. Example: 1
     * @response {
	 *   "cart": []
     * }
    **/
    public function removeFromCart(Request $request)
    {
    	$cart = $request->user()->carts()->firstOrCreate([
    		'business_id' => $request->user()->business_id,
    		'status' => ''
    	]);

    	$item = $cart->items()
    				->where('product_id', $request->product_id)
    				->delete();

    	return $this->getCart($request);
    }

    /**
     * Submit cart
     *
     * Submit cart 
     * @authenticated
     * @response {
	 *   "cart": []
     * }
    **/
    public function submitCart(Request $request)
    {
    	$cart = $request->user()->carts()
    				->withCount('items')
    				->where('business_id', $request->user()->business_id)
    				->where('status', '')
    				->first();


    	if ($cart && $cart->items_count > 0) {
    		$cart->status = 'new_order';
    		$cart->save();

    		return [
    			'message' => 'Order submited'
    		];
    	}

		return [
			'message' => 'You dont have any item'
		];
    }

    /**
     * Get user orders
     *
     * Get user orders
     * @authenticated
     * @response {
	 *   "cart": []
     * }
    **/
    public function getOrders(Request $request)
    {
    	$carts = $request->user()->carts()
    				->withCount('items')
    				->where('status', '!=', '')
    				->with(['items' => function($query) {
						$query->with('product');
			    					// $query->selectRaw('*, product_id, count(*) as quantity')->get();
    				}])
    				->get();

    	$carts = $carts->map(function(& $cart) {
    		$items = $cart->items()
	    			->with('product')
    				->selectRaw('*, count(*) as quantity')
    				->groupBy('product_id')
    				->get()
    				->map(function($item) {
    					$details = $item->product->details();
    					$details['quantity'] = $item['quantity'];
    					return $details;
		    		});


    		return [
    			'id' => $cart->id,
    			'price' => $cart->price,
    			'status' => $cart->status,
    			'created_at' => $cart->created_at,
    			'items_count' => $cart->items_count,
    			'items' => $items,
    		];
    	});

    	return $carts;
    }
}
