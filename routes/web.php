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
	Route::get('/export/yamrket', 'ExportController@yandexMarket')->name('admin.export.yamarket');
	Route::get('/import', 'ImportController@index')->name('admin.import');
	Route::get('/import/create', 'ImportController@create')->name('admin.import.create');
	Route::post('/import', 'ImportController@store')->name('admin.import.store');
	Route::get('/import/preorder', 'ImportController@preorder')->name('admin.import.preorder');
	Route::post('/import/preorderstore', 'ImportController@preorderstore')->name('admin.import.preorderstore');
	Route::get('/import/image', 'ImportController@imgcreate')->name('admin.import.imgcreate');
	Route::get('/import/imgstore', 'ImportController@imgstore')->name('admin.import.imgstore');
	Route::get('/import/quantity', 'ImportController@quantity')->name('admin.import.quantity');
	Route::post('/import/qtystor', 'ImportController@qtystore')->name('admin.import.qtystore');
});

Auth::routes();

Route::get('/', 'StoreController@index')->name('store.index');
Route::get('/store', 'StoreController@shope')->name('store');
Route::get('/store/all-artists', 'StoreController@allartist')->name('all-artists');
Route::get('/collection/{name}', 'StoreController@name')->name('porductname');
Route::get('/store/{slug}/{name?}', 'StoreController@catslug')->name('category');
Route::get('/{category}/{name}/{product}{title}', 'StoreController@view')->name('view.product');
Route::get('/box-sets', 'StoreController@boxset')->name('boxset');
Route::get('/pre-order', 'StoreController@preorder')->name('preorder');
Route::get('/new-products', 'StoreController@newReleas')->name('newproducts');
Route::get('/ganre/{slug}/{category?}', 'StoreController@ganreslug')->name('store.ganre');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::get('/cart/empty', 'CartController@empty')->name('cart.empty');
Route::delete('/cart/destroy/{product}', 'CartController@destroy')->name('cart.destroy');

Route::get('/about', 'StoreController@about')->name('about');
Route::get('/payment', 'StoreController@payment')->name('payment');
Route::get('/delivery', 'StoreController@delivery')->name('delivery');
Route::get('/policy', 'StoreController@policy')->name('policy');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/order', 'OrdersController@store')->name('order.store');
