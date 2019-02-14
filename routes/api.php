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


Route::get('/cells/by/storage/{id}', ['as' => 'cells.by.storage', 'uses'=>'Api\OrderController@getCellByStorageId']);
Route::get('/products/by/cell/{id}', ['as' => 'products.by.cell', 'uses'=>'Api\OrderController@getProductByCellId']);
Route::get('/cars/by/storage/{id}', ['as' => 'cars.by.storage', 'uses'=>'Api\OrderController@getCarByStorageId']);



