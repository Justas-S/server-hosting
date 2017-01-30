<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServerCreate;
use phpseclib\Net\SSH2;
use App\Server;
//use App\Events\ServerInserted;
use App\Jobs\SetUpServer;
use Auth;

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

        $server = Server::create([
            'ip'        => $ip,
            'password'  => $password,
            'provider'  => $request->input('provider'),
            'name'      => $request->input('provider')."-".$ip,
            'user_id'   => Auth::user()->id,
        ]);
        //event(new ServerInserted($server));
        $this->dispatch(new SetUpServer($server));


        //return redirect()->back();
        //return response('success', 200);
        return response()->json(['server_id' => $server->id]);
    }
}
