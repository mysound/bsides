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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function(){
	Route::get('/', 'DashboardController@dashboard')->name('admin.index');
	Route::resource('/category', 'CategoriesController', ['as' => 'admin']);
	Route::resource('/ganre', 'GanresController', ['as' => 'admin']);
	Route::resource('/brand', 'BrandsController', ['as' => 'admin']);
	Route::resource('/product', 'ProductsController', ['as' => 'admin']);
	Route::resource('/vendor', 'VendorsController', ['as' => 'admin']);
	Route::get('/quantity', 'ProductsController@quantity')->name('admin.product.quantity');
	Route::get('/nullify', 'ProductsController@nullifyQuantity')->name('admin.product.nullify');
	Route::get('/export', 'ExportController@index')->name('admin.export');
	Route::get('/export/main', 'ExportController@mainCatalog')->name('admin.export.main');
	Route::get('/import', 'ImportController@index')->name('admin.import');
	Route::get('/import/create', 'ImportController@create')->name('admin.import.create');
	Route::post('/import', 'ImportController@store')->name('admin.import.store');
	Route::get('/import/image', 'ImportController@imgcreate')->name('admin.import.imgcreate');
	Route::get('/import/imgstore', 'ImportController@imgstore')->name('admin.import.imgstore');
});

Auth::routes();

Route::get('/', 'StoreController@index')->name('store.index');
Route::get('/store/view/{product}', 'StoreController@view')->name('view.product');
Route::get('/store', 'StoreController@shope')->name('store');

Route::get('/home', 'HomeController@index')->name('home');
