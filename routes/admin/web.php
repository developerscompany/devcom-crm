<?php

Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {

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

    Route::prefix('hostings')->group(
        function () {

            Route::get('/', 'HostingController@index');
            Route::get('/account/{hosting}', 'HostingController@show');
            Route::get('/add', 'HostingController@add');
            Route::post('/create', 'HostingController@create');



        }
    );

});