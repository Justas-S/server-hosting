<?php 
Route::group(['prefix' => 'vartotojas', 'as' => 'user.', 'middleware' => 'IsLoggedIn'], function() {

    Route::get('/mano-meniu', [
        'as'    => 'index',
        'uses'  => 'UserController@index'
    ]);
    
});