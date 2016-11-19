<?php 
Route::group(['prefix' => 'vartotojas', 'as' => 'user.', 'middleware' => 'IsLoggedIn'], function() {

    Route::get('pagr', [
        'as'    => 'index',
        'uses'  => 'UserController@index'
    ]);
});