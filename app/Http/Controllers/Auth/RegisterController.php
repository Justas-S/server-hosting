<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Hash;
use Auth;

class RegisterController extends Controller
{

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $username = $request->input('username');
        $password = Hash::make($request->input('password'));
        $email = $request->input('email');

        $user = User::create([
            'username'  => $username,
            'password'  => $password,
            'email'     => $email,
        ]);

        Auth::attempt(['username' => $username, 'password' => $password], true);

        flash()->success('Sėkmingai užsiregistravai!');
        return redirect()->route('home');
    }
}
