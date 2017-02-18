<?php 

Route::group(['middleware' => 'IsLoggedIn', 'prefix' => '/zaidimu_serveriai', 'as' => 'gameserver.'], function () {

    Route::get('/', [
        'as'        => 'index',
        'uses'      => 'GameServerController@index'
    ]); 

    Route::get('{gameserver}/valdymas', [
        'as'        => 'management',
        'uses'      => 'GameServerController@management',
        'middleware'=> 'IsGameServerOwner'
    ]);
});