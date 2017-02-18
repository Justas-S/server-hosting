<?php 

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GameServer;
use App\User;
use Hash;
use Auth;

class GameServerController extends Controller
{   
    private $gameserver_manager;

    public function __construct(\App\Services\GameServerManager $manager)
    {
        $this->gameserver_manager = $manager;
    }

    public function getConfig(GameServer $gameserver) 
    {
        $config = $this->gameserver_manager->getServerConfig($gameserver);
        $decoded = json_decode($config);
        // Remove rcon password, it has a different endpoint
        unset($decoded->rcon_password);
        return json_encode($decoded);
    }

    public function postConfig(GameServer $gameserver)
    {
        
    }

    public function show(GameServer $gameserver) 
    {
        $gameserver->game;
        $gameserver->server_package;
        return $gameserver->toJson();
    }

    public function rcon(GameServer $gameserver, Request $request)
    {   
        $username = $request->get('username');
        $password = $request->get('password');
        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            return json_encode(json_decode($this->gameserver_manager->getServerConfig($gameserver))->rcon_password);
        } else {
            return response('Neteisingas vartotojo vardas ir/ar slaptažodis', 401);
        }
    }   
}
