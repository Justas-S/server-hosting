<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\GameServer;

class IsGameServerOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {     
        $gameserver = GameServer::findOrFail($request->route('gameserver'));  
        if (!$gameserver->user || $gameserver->user->id != Auth::user()->id) {
            flash()->error("Jūs neesate išsinuomavęs šio serverio.");
            return back();
        }
        return $next($request);
    }
}
