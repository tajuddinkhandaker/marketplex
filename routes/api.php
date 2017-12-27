<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api', 'as' => 'user::'], function () {

    Route::get('/stores/{store}/products', [ 'uses' => 'StoreController@showProducts', 'as' => 'store.products' ]);     
    Route::get('/products/{product}/price', [ 'uses' => 'ProductController@showPrice', 'as' => 'product.price' ]);     
    Route::get('/templates/{view}', [ 'uses' => 'SaleController@getTemplate', 'as' => 'sales.template' ]);     

	// Product controller
	Route::group([ 'prefix' => 'products' ], function () {
		
		Route::get('/medias/image/{file_name}', [ 'uses' => 'ProductController@image', 'as' => 'products.medias.image' ]);
		Route::get('/medias/thumbnail/{file_name}', [ 'uses' => 'ProductController@thumbnail', 'as' => 'products.image.thumbnail' ]);
	    Route::get('/{product}/quick-view', [ 'uses' => 'ProductController@quickView', 'as' => 'products.quick.view' ]);
	});

	// Sale Controller
	Route::resource('sales', 'SaleController');

	// Bill controller
	Route::group([ 'prefix' => 'bills' ], function () {

		Route::resource('products', 'ProductBillController');
		Route::resource('shippings', 'ShippingBillController');
		Route::resource('payments', 'BillPaymentController');
	});
	// Expense controller
	Route::resource('deposites', 'DepositController');
	Route::resource('expenses', 'ExpenseController');

	// Settings controller
	Route::group([ 'prefix' => 'settings' ], function () {

		Route::resource('banks', 'BankController');
		Route::resource('clients', 'ClientController');
	});
});