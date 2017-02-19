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

//Rutas Vendedor

Route::get('sellers', 'SellersController@index');
Route::get('sellers/{id}', 'SellersController@show');
Route::post('sellers', 'SellersController@store');
Route::put('sellers/{id}', 'SellersController@update');
Route::patch('sellers/{id}', 'SellersController@update');
Route::delete('sellers/{id}', 'SellersController@destroy');
Route::post('sellers/addresses/{id}', 'SellersController@store');
Route::put('sellers/addresses/{id}', 'SellersController@update');

//Rutas producto

Route::get('products', 'ProductsController@index');
Route::get('products/{id}', 'ProductsController@show');
Route::post('products', 'ProductsController@store');
Route::put('products/{id}', 'ProductsController@update');
Route::patch('products/{id}', 'ProductsController@update');
Route::delete('products/{id}', 'ProductsController@destroy');
Route::post('products/reviews/{id}', 'ProductsController@store_review');
Route::get('products/reviews/{id}', 'ProductsController@show_reviews');
Route::delete('products/review/{id}/{id_review}', 'ProductsController@delete_review')
