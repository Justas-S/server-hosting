<?php 
Route::group(['as' => 'service.', 'prefix' => '/paslaugos'], function() {
    Route::get('/', [
        'as'    => 'index',
        'uses'  => 'ServiceController@index'
    ]);

    Route::group(['middleware' => 'IsLoggedIn'], function() {
        Route::get('/{service}/pirkti', [
            'as'    => 'buy',
            'uses'  => 'ServiceController@buy',
        ]);

        Route::get('/patvirtintas', [
            'as'    => 'accept',    
            'uses'  => 'ServiceController@accept',
        ]);

        Route::get('/atmestas', [
            'as'    => 'cancel',
            'uses'  => 'ServiceController@cancel',

        ]);

        Route::get('/apmoketa', [
            'as'    => 'callback',
            'uses'  => 'ServiceController@callback',
        ]);
    });
});