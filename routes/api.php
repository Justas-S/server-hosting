<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('/api/gameservers/{ip}/price', function($ip) {
    return \App\GameServer::where('ip', '=', $ip)->firstOrFail()->hourly_cost;
});


Route::get('/server-package/', function (Request $request) {
    $game_id = $request->get('game_id');
    if ($game_id) 
        return App\ServerPackage::where('game_id', $game_id)->get();
    else 
        return App\ServerPackage::all();
});

Route::get('/plugin/', function (Request $request) {
    $game_id = $request->get('game_id');
    if ($game_id) 
        return App\Plugin::where('game_id', $game_id)->get();
    else 
        return App\Plugin::all();
});