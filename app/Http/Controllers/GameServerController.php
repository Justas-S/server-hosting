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
}
