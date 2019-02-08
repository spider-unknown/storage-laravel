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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/categories',[

    'uses' => 'CategoryController@index',
    'as' => 'category.index'

]);

Route::get('/category/create',[

    'uses' => 'CategoryController@create',
    'as' => 'category.create',

]);

Route::post('/category/store',[

    'uses' => 'CategoryController@store',
    'as' => 'category.store',

]);


Route::get('/category/delete/{id}',[

    'uses' => 'CategoryController@destroy',
    'as' => 'category.delete',

]);


Route::get('/category/edit/{id}',[

    'uses' => 'CategoryController@edit',
    'as' => 'category.edit',

]);


Route::post('/category/update/{id}',[

    'uses' => 'CategoryController@update',
    'as' => 'category.update',

]);

Route::get('/types',[

    'uses' => 'TypeController@index',
    'as' => 'type.index'

]);

Route::get('/type/create',[

    'uses' => 'TypeController@create',
    'as' => 'type.create'

]);

Route::post('/type/store',[

    'uses' => 'TypeController@store',
    'as' => 'type.store'

]);


Route::get('/type/edit/{id}',[

    'uses' => 'TypeController@edit',
    'as' => 'type.edit'

]);


Route::post('/type/update/{id}',[

    'uses' => 'TypeController@update',
    'as' => 'type.update'

]);


Route::get('/type/delete/{id}',[

    'uses' => 'TypeController@destroy',
    'as' => 'type.delete'

]);

Route::get('/products',[

    'uses' => 'ProductsController@index',
    'as' => 'products.index'

]);

Route::get('/product/create',[

    'uses' => 'ProductsController@create',
    'as' => 'product.create'

]);

Route::post('/product/store',[

    'uses' => 'ProductsController@store',
    'as' => 'product.store'

]);

Route::get('/product/delete/{id}',[

    'uses' => 'ProductsController@destroy',
    'as' => 'product.delete',

]);


Route::get('/product/kill/{id}',[

    'uses' => 'ProductsController@kill',
    'as' => 'product.kill',

]);

Route::get('/product/trashed',[
    'uses' => 'ProductsController@trashed',
    'as' => 'products.trashed'
]);


Route::get('/product/restore/{id}',[
    'uses' => 'ProductsController@restore',
    'as' => 'product.restore'
]);

Route::get('/product/edit/{id}',[
    'uses' => 'ProductsController@edit',
    'as' => 'product.edit'
]);

Route::post('/product/update/{id}',[
    'uses' => 'ProductsController@update',
    'as' => 'product.update'
]);


Route::post('/cell/store',[
    'uses' => 'CellController@store',
    'as' => 'cell.store'
]);


Route::get('/cell/create',[
    'uses' => 'CellController@create',
    'as' => 'cell.create'
]);

Route::get('/cells',[
    'uses' => 'CellController@index',
    'as' => 'cells.index'
]);

Route::get('/cells/edit/{id}',[
    'uses' => 'CellController@edit',
    'as' => 'cell.edit'
]);


Route::post('/cells/update/{id}',[
    'uses' => 'CellController@update',
    'as' => 'cell.update'
]);

Route::get('/cells/delete/{id}',[
    'uses' => 'CellController@destroy',
    'as' => 'cell.delete'
]);

Route::get('/storages',[
    'uses' => 'StorageController@index',
    'as' => 'storage.index'
]);

Route::get('/storages/create',[
    'uses' => 'StorageController@create',
    'as' => 'storage.create'
]);

Route::post('/storages/store',[
    'uses' => 'StorageController@store',
    'as' => 'storage.store'
]);

Route::post('/storages/update/{id}',[
    'uses' => 'StorageController@update',
    'as' => 'storage.update'
]);

Route::get('/storages/edit/{id}',[
    'uses' => 'StorageController@edit',
    'as' => 'storage.edit'
]);

Route::get('/storages/delete/{id}',[
    'uses' => 'StorageController@destroy',
    'as' => 'storage.delete'
]);

Route::get('/cars',[
    'uses' => 'CarController@index',
    'as' => 'cars.index'
]);

Route::get('/car/create',[
    'uses' => 'CarController@create',
    'as' => 'car.create'
]);

Route::post('/car/store',[
    'uses' => 'CarController@store',
    'as' => 'car.store'
]);

Route::get('/car/edit/{id}',[
    'uses' => 'CarController@edit',
    'as' => 'car.edit',
]);


Route::post('/car/update/{id}',[
    'uses' => 'CarController@update',
    'as' => 'car.update',
]);

Route::get('/car/delete/{id}',[
    'uses' => 'CarController@destroy',
    'as' => 'car.delete',

]);


