<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;
        return view('user.index', compact('user', 'orders'));
    }
}
