<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/menu', 'MenuController@index')->name('menu');

Route::get('/content', function () {
    return view('sites.content');
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', 'AdminController@admin');

Route::get('user/{id}', ['as' => 'user.profile', 'uses' => 'UserController@profile', 'middleware' => 'auth']);

Route::post('user/{id}', 'UserController@editProfile')->name('user.edit');

Route::get('product/{id}', 'ProductController@detail')->name('product.detail');

// login facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
    
//API
Route::group(['prefix' => 'api/v1'], function () {
	Route::get('foods','ProductController@getdata_food');
	Route::get('drinks','ProductController@getdata_drink');
	Route::get('all_foods','ProductController@all_food');
	Route::get('all_drinks','ProductController@all_drink');
	// Route::get('delete_customer/{id}',function($id){
	// 	return App\Customer::destroy($id);
	// });
	// Route::get('delete_food/{id}',function($id){
	// 	return App\Product::destroy($id);
	// });
	// Route::get('delete_drink/{id}',function($id){
	// 	return App\Product::destroy($id);
	// });
});

Route::group(['prefix' => 'admin'], function () {
	Route::get('home','AdminController@home')->name('admin_home');
	Route::get('manage_food','AdminController@manage_food')->name('manage_food');
	Route::get('manage_drink','AdminController@manage_drink')->name('manage_drink');
	Route::get('manage_customer','AdminController@manage_customer');
});
