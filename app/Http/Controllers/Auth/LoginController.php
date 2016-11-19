<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Auth;

class LoginController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        if(Auth::attempt(['username' => $username, 'password' => $password]))
        {
            return redirect()->route('home');
        }
        return redirect()->back();
    }

    public function logout() 
    {
        Auth::logout();
        flash()->success("Sėkmingai atsijungėte.");
        return redirect('/');
    }
}
