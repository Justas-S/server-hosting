<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GameServerVersionStore;
use App\Events\GameServerVersionChangeEvent;
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

    public function manageVersion(GameServer $gameserver)
    {
        return view('gameserver.version', compact('gameserver'));
    }

    public function postVersion(GameServer $gameserver, GameServerVersionStore $request)
    {
        $gameserver->server_package_id = $request->get('server_package_id');
        $gameserver->save();
        event(new GameServerVersionChangeEvent($gameserver, $gameserver->server_package));
        flash()->success("Serverio versija sėkmingai atnaujinta į {$gameserver->server_package->version}");
        return redirect()->route('gameserver.management', $gameserver->id);
    }
}
