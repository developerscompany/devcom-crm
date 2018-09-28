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

require("admin/web.php");

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
Route::get('/invite/{token}', 'Auth\RegisterController@verifyCust');
Route::post('/savepassword/{id}', 'Auth\RegisterController@save');

/*Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {

    Route::get('/', 'HomeController@index');

    Route::get('/users', 'UserController@index');
    Route::get('get-users', 'UserController@getUsers');
    Route::get('get-roles', 'UserController@getRoles');

    Route::post('edit-roles', 'UserController@editRole');

    Route::get('/bids', 'BidsController@index');

    Route::get('lines', 'BidsController@show');
    Route::get('agents', 'BidsController@getAgent');
    Route::get('sources', 'BidsController@getSource');
    Route::get('statuss', 'BidsController@getStatus');

});*/

Route::prefix('user')->namespace('User')->middleware('sale')->group(function () {

    Route::get('/', 'HomeController@bids');
    Route::post('/bid/add', 'HomeController@store');
    Route::get('/cab', 'HomeController@index');

    Route::get('/bids-stat', 'HomeController@stat');

    Route::get('lines', 'HomeController@show');
    Route::get('agents', 'HomeController@getAgent');
    Route::get('sources', 'HomeController@getSource');
    Route::get('statuss', 'HomeController@getStatus');

    Route::post('add-customer', 'BidsCustomersController@store');
    Route::post('add-google-line', 'HomeController@store');

    Route::post('edit-google-line', 'HomeController@update');
    Route::post('edit-bid-response', 'HomeController@bidResp');
    Route::post('edit-bid-exec', 'HomeController@bidExec');
    Route::post('edit-bid-comm', 'HomeController@bidComm');

});