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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function(){
	Route::get('/', 'DashboardController@dashboard')->name('admin.index');
	Route::resource('/category', 'CategoriesController', ['as' => 'admin']);
	Route::resource('/ganre', 'GanresController', ['as' => 'admin']);
	Route::resource('/brand', 'BrandsController', ['as' => 'admin']);
	Route::resource('/product', 'ProductsController', ['as' => 'admin']);
	Route::get('/export', 'ExportController@index')->name('admin.export');
	Route::get('/export/main', 'ExportController@mainCatalog')->name('admin.export.main');
	Route::get('/import', 'ImportController@index')->name('admin.import');
	Route::get('/import/maincreate', 'ImportController@mainCreate')->name('admin.import.maincreate');
	Route::post('/import', 'ImportController@mainStore')->name('admin.import.mainstore');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
