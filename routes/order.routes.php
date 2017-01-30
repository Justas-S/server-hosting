<?php 


Route::group(['middleware' => 'IsLoggedIn', 'as' => 'order.', 'prefix' => 'uzsakymas'], function() {

    Route::get('/patvirtintas', [
        'as'    => 'accept',    
        'uses'  => 'OrderController@accept',
    ]);

    Route::get('/atmestas', [
        'as'    => 'cancel',
        'uses'  => 'OrderController@cancel',

    ]);

    Route::get('/apmoketa', [
        'as'    => 'callback',
        'uses'  => 'OrderController@callback',
    ]);

    Route::post('/uzsakyti', [
        'as'    => 'store',
        'uses'  => 'OrderController@store'
    ]); 

    Route::get('/uzsakyti/{game}', [
        'as'    => 'create',
        'uses'  => 'OrderController@create'
    ]);

    Route::get('/vartotojas/{user}', [
        'as'    => 'user',
        'uses'  => 'OrderController@showUser'
    ]);

});