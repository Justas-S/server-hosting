<?php 


Route::get('/api/gameservers/{ip}/price', function($ip) {
    return \App\GameServer::where('ip', '=', $ip)->firstOrFail()->hourly_cost;
});


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