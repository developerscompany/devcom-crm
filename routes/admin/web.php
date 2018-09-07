<?php

Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {

    Route::get('/', 'HomeController@index');

    Route::get('/users', 'UserController@index');
    Route::get('/user/{user}', 'UserController@show');
    Route::get('get-users', 'UserController@getUsers');
    Route::get('get-roles', 'UserController@getRoles');

    Route::post('edit-roles', 'UserController@editRole');
    Route::post('invite', 'UserController@inviteUser');

    Route::get('/bids', 'BidsController@index');

    Route::get('lines', 'BidsController@show');
    Route::get('agents', 'BidsController@getAgent');
    Route::get('sources', 'BidsController@getSource');
    Route::get('statuss', 'BidsController@getStatus');

    Route::prefix('hostings')->group(
        function () {

            // Account list

            Route::get('/', 'HostingController@index');
            Route::get('/account/{hosting}', 'HostingController@show');
            Route::post('/account/{hosting}/comment', 'HostingController@getComment');
            Route::get('/account/{hosting}/edit', 'HostingController@edit');
            Route::get('/account/{hosting}/sale', 'HostingController@getSale');
            Route::get('/account/{hosting}/archive', 'HostingController@archive');
            Route::post('/account/{hosting}/sale', 'HostingController@sale');
            Route::post('/account/{hosting}/update', 'HostingController@update');
            Route::get('/add', 'HostingController@add');
            Route::post('/create', 'HostingController@create');

            // Calendar

            Route::get('/calendar', 'HostingController@getCalendar');


            // Servers

            Route::get('/servers', 'HostingController@getServers');
            Route::post('/server/add', 'HostingController@addServer');
            Route::post('/server/edit', 'HostingController@editServer');
            Route::post('/server/del/{server}', 'HostingController@deleteServer');


            // Export xls

            Route::get('/export', 'HostingController@getExport');
            Route::post('/export', 'HostingController@export');


            // WS api

            Route::get('/api', 'HostingController@api');

        }
    );

});
