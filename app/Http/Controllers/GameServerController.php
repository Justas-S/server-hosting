<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GameServer;

class GameServerController extends Controller
{
    public function index()
    {
        $gameservers = GameServer::all();
        return view('gameserver.index', compact('gameservers'));
    }

    public function management(GameServer $gameserver)
    {
        return view('gameserver.management', compact('gameserver'));
    }
}
