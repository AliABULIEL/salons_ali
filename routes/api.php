<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Register (POST)
Route::post('register', 'AuthController@register');

// Login "send sms contains code" (POST)
Route::post('login', 'AuthController@login');

// Verify code and respone with token. (POST)
Route::post('verify', 'AuthController@verify');

Route::post('home', 'HomeController@get');

Route::post('services', 'ServicesController@get');

Route::post('products', 'ProductsController@list');

Route::get('terms-of-use', 'PagesController@termsOfUse');

Route::get('about', 'PagesController@about');

Route::middleware('auth:sanctum')->group(function () {
	Route::get('user', 'UsersController@show');

	Route::post('user', 'UsersController@update');

	Route::post('orders/active', 'OrdersController@active');
	Route::post('orders/archived', 'OrdersController@archived');
	Route::post('orders/waiting-approval', 'OrdersController@waitingApproval');

	Route::post('orders/{id}/update', 'OrdersController@updateOrder');
	Route::post('orders/{id}/cancel', 'OrdersController@cancelOrder');
	Route::post('orders/{id}/approve', 'OrdersController@approveOrder');
	Route::post('orders/{id}', 'OrdersController@getOrder');
	Route::post('workshop-orders/{id}/update', 'OrdersController@updateWorkshopOrder');
	// Route::post('wishlist/submit', 'CartController@wishlist');

	Route::post('contact-messages', 'ContactMessagesConroller@store');

	Route::post('create-order/submit-services', 'CreateOrderController@submitServices');
	Route::post('create-order/submit-employee', 'CreateOrderController@submitEmployee');
	Route::post('create-order/submit-day', 'CreateOrderController@submitDay');
	Route::post('create-order/submit-time', 'CreateOrderController@submitTime');
	Route::post('create-order/submit-order', 'CreateOrderController@submitOrder');

	Route::post('create-workshop-order/employees', 'CreateWorkshopOrderController@getEmployees');
	Route::post('create-workshop-order/submit-employee', 'CreateWorkshopOrderController@submitEmployee');
	Route::post('create-workshop-order/submit-workshop', 'CreateWorkshopOrderController@submitWorkshop');
	Route::post('create-workshop-order/submit-day', 'CreateWorkshopOrderController@submitDay');
	Route::post('create-workshop-order/submit-time', 'CreateWorkshopOrderController@submitTime');
	Route::post('create-workshop-order/submit-order', 'CreateWorkshopOrderController@submitOrder');
	


	Route::post('notifications', 'NotificationsController@list');
	Route::post('notifications/read-all', 'NotificationsController@readAll');

	Route::get('stories', 'StoriesController@list');
	Route::post('stories/{id}/view', 'StoriesController@view');
	Route::post('stories', 'StoriesController@create');
	Route::post('stories/delete', 'StoriesController@delete');

	Route::post('business/{id}/update', 'BusinessesController@update');
	Route::post('business/{id}/clients', 'BusinessesController@clients');
	Route::post('business/{id}/clients/suspend', 'BusinessesController@suspendClient');
	Route::post('business/{id}/clients/unsuspend', 'BusinessesController@unsuspendClient');

	Route::post('cart', 'CartController@getCart');
	Route::post('cart/add', 'CartController@addToCart');
	Route::post('cart/remove', 'CartController@removeFromCart');
	Route::post('cart/submit', 'CartController@submitCart');
	Route::post('cart/orders', 'CartController@getOrders');

	Route::post('upload', 'UploadController@store');
});

Route::get('business/{id}', 'BusinessesController@get');