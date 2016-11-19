<?php 


Route::group(['prefix' => '/auth', 'as' => 'auth.'], function() {

    Route::group(['middleware' => 'IsGuest'], function() {
        Route::get('/prisijungti', [
            'as'    => 'login',
            'uses'  => 'Auth\LoginController@login'
        ]); 

        Route::post('/prisijungti', [
            'as'    => 'postLogin',
            'uses'  => 'Auth\LoginController@postLogin'
        ]);

        Route::get('/registruotis', [
            'as'    => 'register',
            'uses'  => 'Auth\RegisterController@register'
        ]);

        Route::post('/registruotis', [
            'as'    => 'postRegister',
            'uses'  => 'Auth\RegisterController@postRegister'
        ]);
    });

    Route::get('/atsijungti', [
        'as'            => 'logout',
        'uses'          => 'Auth\LoginController@logout',
        'middleware'    => 'IsLoggedIn',
    ]);
});