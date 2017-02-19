<?php 

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SampConfigStore;
use App\Events\GameServerPluginInstallEvent;
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
        session()->forget('double_auth');
        $config = $this->gameserver_manager->getServerConfig($gameserver);
        $decoded = json_decode($config);
        // Remove rcon password, it has a different endpoint
        unset($decoded->rcon_password);
        return json_encode($decoded);
    }

    public function postConfig(GameServer $gameserver, SampConfigStore $request)
    {
        $data = [
            'language' => $request->input('language'),
            'maxnpc'   => $request->input('maxnpc'),
            'mapname'  => $request->input('mapname'),
        ];
        if ($request->has('rcon_password')) $data['rcon_password'] = $request->get('rcon_password');

        if ($this->gameserver_manager->setServerConfig($gameserver, json_encode($data))) {
            return response('', 200);
        }
        return response('fail', 500);
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
            session(['double_auth' => 'true']);
            return json_encode(json_decode($this->gameserver_manager->getServerConfig($gameserver))->rcon_password);
        } else {
            return response('Neteisingas vartotojo vardas ir/ar slaptažodis', 401);
        }
    }   

    public function plugins(GameServer $gameserver)
    {
        $config = json_decode($this->gameserver_manager->getServerConfig($gameserver));
        $plugins = [];
        foreach ($config->plugins as $plugin) {
            $plugin = rtrim($plugin, '.so');
            $plugins[] = \App\Plugin::where('name', '=', $plugin)->first();
        }
        return json_encode($plugins);
    }

    public function postPlugins(GameServer $gameserver, Request $request) 
    {
        $plugins = \App\Plugin::whereIn('id', $request->get('plugins'))->get();
        event(new GameServerPluginInstallEvent($gameserver, $plugins->toBase()));
        return response('success', 200);
    }
}
