
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
})->middleware('auth:api');

//Rutas Vendedor
Route::get('sellers', 'SellersController@index');
Route::get('sellers/{id}', 'SellersController@show');
Route::post('sellers', 'SellersController@store');
Route::put('sellers/{seller}', 'SellersController@update');
Route::patch('sellers/{seller}', 'SellersController@update');
Route::delete('sellers/{seller}', 'SellersController@destroy');

//Rutas direcciones-vendedor
Route::post('sellers/{seller}/address', 'SellersController@store_address');
Route::put('sellers/{seller}/address', 'SellersController@update_address');

//Rutas producto
Route::get('products','ProductsController@index');
Route::get('products/{id}', 'ProductsController@show');
Route::post('products', 'ProductsController@store');
Route::put('products/{products}', 'ProductsController@update');
Route::patch('products/{products}', 'ProductsController@update');
Route::delete('products/{products}', 'ProductsController@destroy');

//Rutas reseñas
Route::post('products/{products}/review', 'ProductsController@store_review');
Route::get('products/{products}/reviews', 'ProductsController@index_review');
Route::delete('products/{products}/review', 'ProductsController@destroy_review');

//Rutas etiquetas
Route::get('labels','ProductsController@index_label');
