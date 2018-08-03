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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {

    Route::get('/bids', 'HomeController@index');

    Route::get('lines', 'HomeController@show');
    Route::get('agents', 'HomeController@getAgent');
    Route::get('sources', 'HomeController@getSource');
    Route::get('statuss', 'HomeController@getStatus');

});

Route::prefix('user')->namespace('User')->middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index');

    Route::get('lines', 'HomeController@show');
    Route::get('agents', 'HomeController@getAgent');
    Route::get('sources', 'HomeController@getSource');
    Route::get('statuss', 'HomeController@getStatus');

    Route::post('add-google-line', 'HomeController@store');

});