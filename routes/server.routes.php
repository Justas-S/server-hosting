<?php 

Route::group(['middleware' => 'IsLoggedIn', 'as' => 'server.', 'prefix' => '/serveris'], function() {

    Route::get('/prideti', [
        'as'    => 'create',
        'uses'  => 'ServerController@create'
    ]); 

    Route::post('/prideti', [
        'as'    => 'store',
        'uses'  => 'ServerController@store'
    ]);
});