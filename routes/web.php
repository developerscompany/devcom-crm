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

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::get('/', 'HomeController@index')->name('home');


Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {

    Route::get('/manager-add', 'ManagerController@store');

});

Route::prefix('user')->middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index');

});