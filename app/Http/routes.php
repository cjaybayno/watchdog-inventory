<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// When domain hit, redirect to login by middleware
Route::get('/', ['middleware' => 'auth', function () {}]);

// Login routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


// Social authentication
Route::group(['prefix' => 'auth'], function () {
	// Facebook auth...
	Route::get('fb', 'Auth\AuthController@fbRedirectToProvider');
	Route::get('fb/callback', 'Auth\AuthController@fbHandleProviderCallback');
	// Google auth
	Route::get('google', 'Auth\AuthController@googleRedirectToProvider');
	Route::get('google/callback', 'Auth\AuthController@googleHandleProviderCallback');
});


// authenticated route
Route::group(['middleware' => 'auth'], function() {
	
	//dashboard
	Route::controller('dashboard', 'DashboardController');
	
	//items route
	Route::controller('items', 'ItemsController', [
		'getIndex'  => 'items',
		'getCreate' => 'items.create',
		'getShow' 	=> 'items.show',
		'getEdit'   => 'items.edit',
		'getDelete' => 'items.delete',
		'postStore' => 'items.store',
		'postUpdate'=> 'items.update',
	]);
	
	//items category route
	Route::controller('items-category', 'ItemsCategoryController', [
		'getIndex'  => 'items_category',
	]);
	
	//items uom route
	Route::controller('items-uom', 'ItemsUnitOfMeasurement', [
		'getIndex'  => 'items_uom',
	]);
	
	//branches route
	Route::controller('branches', 'BranchesController', [
		'getIndex'  => 'branches',
		'getCreate' => 'branches.create',
		'getShow' 	=> 'branches.show',
		'getEdit'   => 'branches.edit',
		'getDelete' => 'branches.delete',
		'postStore' => 'branches.store',
		'postUpdate'=> 'branches.update',
	]);
	
	//supplier routes
	Route::controller('suppliers', 'SuppliersController', [
		'getIndex'  => 'suppliers',
		'getCreate' => 'suppliers.create',
		'getShow'	=> 'suppliers.show',
		'getEdit'   => 'suppliers.edit',
		'getDelete' => 'branches.delete',
		'postStore' => 'suppliers.store',
		'postUpdate'=> 'suppliers.update',
	]);
	
	Route::controller('purchases', 'PurchasesController', [
		'getIndex' 	=> 'purchases',
		'getCreate' => 'purchases.create',
	]);
	
	// purchase route: show purchase item  page
	// Route::get('purchases/purchase-item', [
		// 'as'   => 'purchase.item',
		// 'uses' => 'PurchasesController@create'
	// ]);
	/*
	// purchase route: send to server purchase item
	Route::post('purchases/save', [
		'as'   => 'purchase.item.post',
		'uses' => 'PurchasesController@store'
	]);
	//purchase route: show all list
	Route::get('purchases', [
		'as'   => 'purchase.list',
		'uses' => 'PurchasesController@index'
	]);	
	//purchase route: paginate list
	Route::get('purchases/paginate', ['uses' => 'PurchasesController@paginate']);
	*/
	
	// Users Routes
	Route::get('user/register', 	 'UserController@create');
	Route::post('user/register',	 'UserController@store');
	Route::get('user', 		    	 'UserController@index');
	Route::get('user/paginate', 	 'UserController@paginate');
	Route::get('user/edit/{id}',     	 'UserController@edit');
	Route::get('user/{id}',     'UserController@show');
	Route::post('user/update/{id}',  'UserController@update');
	Route::get('user/delete/{id}',   'UserController@destroy');
});

