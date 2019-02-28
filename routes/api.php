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


Route::get('/cells/by/storage/{id}', ['as' => 'cells.by.storage', 'uses' => 'Api\OrdersController@getCellByStorageId']);
Route::get('/products/by/cell/{id}', ['as' => 'products.by.cell', 'uses' => 'Api\OrdersController@getProductByCellId']);
Route::get('/cars/by/storage/{id}', ['as' => 'cars.by.storage', 'uses' => 'Api\OrdersController@getCarByStorageId']);
Route::get('storages', 'Api\StoragesController@index');
Route::get('cells', 'Api\CellsController@index');
Route::get('categories', 'Api\CategoriesController@index');
Route::get('products', 'Api\ProductsController@index');
Route::get('cars', 'Api\CarsController@index');
Route::get('orders', 'Api\OrderController@index');
Route::post('login', 'Api\UsersController@login');

Route::post('storages', 'Api\StoragesController@store');
Route::get('storage/delete/{id}', 'Api\StoragesController@delete');
Route::post('storage/update/{id}', 'Api\StoragesController@update');
Route::post('cars', 'Api\CarsController@store');
Route::post('car/update/{id}', 'Api\CarsController@update');
Route::get('car/delete/{id}', 'Api\CarsController@delete');
Route::post('categories', 'Api\CategoriesController@store');
Route::post('category/update/{id}', 'Api\CategoriesController@update');
Route::get('category/delete/{id}', 'Api\CategoriesController@delete');
Route::post('cells', 'Api\CellsController@store');
Route::post('cell/update/{id}', 'Api\CellsController@update');
Route::get('cell/delete/{id}', 'Api\CellsController@delete');
Route::post('products', 'Api\ProductsController@store');
Route::post('product/update/{id}', 'Api\ProductsController@update');
Route::get('product/delete/{id}', 'Api\ProductsController@delete');
Route::post('orders', 'Api\OrderController@store');
Route::post('order/update/{id}', 'Api\OrderController@update');
Route::get('order/delete/{id}', 'Api\OrderController@delete');







Route::group(['middleware' => 'auth:api'], function () {
    Route::post('storages', 'Api\StoragesController@store');


});





