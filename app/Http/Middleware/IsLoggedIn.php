<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsLoggedIn
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
        if(!Auth::check()) {
            flash()->error("Norėdami atlikti šį veiksmą turite prisijungti.");
            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
