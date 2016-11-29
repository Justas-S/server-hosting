<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServerCreate;
use phpseclib\Net\SSH2;
use App\Server;
use App\Events\ServerInserted;

class ServerController extends Controller
{
    public function create()
    {
        return view('server.create');
    }

    public function store(ServerCreate $request)
    {
        $ip = $request->input('ip');
        $password = $request->input('password');
        /*
        $ssh = new SSH2($ip);
        try {
            $ssh->login('root', $password)
        } catch(\Exception $e) {
            return response()->json(['error' => 'cant connect']);
        }

        if(!$ssh->isAuthenticated())
            return response()->json('error' => 'auth failed');


        $ssh->disconnect();*/

        $server = Server::create([
            'ip'        => $ip,
            'password'  => $password,
            'provider'  => $request->input('provider'),
            'name'      => $request->input('provider')."-".$ip
        ]);
        event(new ServerInserted($server));


        //return redirect()->back();
        return response('success', 200);
    }
}
