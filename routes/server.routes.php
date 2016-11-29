<?php 

Route::group(['as' => 'server.', 'prefix' => '/serveris'], function() {

    Route::get('/prideti', [
        'as'    => 'create',
        'uses'  => 'ServerController@create'
    ]); 

    Route::post('/prideti', [
        'as'    => 'store',
        'uses'  => 'ServerController@store'
    ]);
});