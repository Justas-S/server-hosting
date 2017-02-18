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

    Route::get('{gameserver}/valdymas/versija', [
        'as'        => 'management.version',
        'uses'      => 'GameServerController@manageVersion',
        'middleware'=> 'IsGameServerOwner'
    ]);

    Route::post('{gameserver}/valdymas/versija', [
        'as'        => 'management.version.post',
        'uses'      => 'GameServerController@postVersion',
        'middleware'=> 'IsGameServerOwner'
    ]);
});