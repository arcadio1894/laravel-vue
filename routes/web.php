<?php

use Illuminate\Support\Facades\Route;

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
    return view('product_dashboard');
});

Route::name('product.')->group(function () {
  Route::get('product','ProductController@index')->name('index');
  Route::post('product','ProductController@store')->name('store');
  Route::get('product/create','ProductController@create')->name('create');
  Route::get('product/{product}','ProductController@show')->name('show');
  Route::put('product/{product}','ProductController@update')->name('update');
  Route::delete('product/{product}','ProductController@destroy')->name('destroy');
  Route::delete('product/{product}/deshabilitar','ProductController@deshabilitar')->name('deshabilitar');
  Route::get('product/{product}/edit','ProductController@edit')->name('edit');
  Route::post('product/deshabilitar','ProductController@deshabilitar');
});
