<?php 



Route::group(['middleware' => 'IsGameServerOwner', 'prefix' => '/gameservers', 'as' => 'ajax.gameserver'], function () {
    Route::get('/{gameserver}/server.cfg', [
        'as'        => 'config',
        'uses'      => 'GameServerController@getConfig',
    ]);

    Route::post('/{gameserver}/server.cfg', [
        'as'        => 'config.post',
        'uses'      => 'GameServerController@postConfig',
    ]);

    Route::get('/{gameserver}/', [
        'as'        => 'show',
        'uses'      => 'GameServerController@show',
    ]);

    Route::post('/{gameserver}/rcon', [
        'as'        => 'rcon',
        'uses'      => 'GameServerController@rcon',
    ]);
});