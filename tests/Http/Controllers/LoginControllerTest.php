<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;


class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;


    public function testLogin()
    {
        $password = 'gsiefngtijgnfijrgtngf654';
        $user = factory(User::class)->create(['password' => bcrypt($password)]);

        Session::start();
        $this->route('POST', 'auth.postLogin', [], [
                '_token'    => Session::token(),
                'username'  => $user->username,
                'password'  => $password
            ]);


        $this->assertTrue(Auth::check());
    }

    public function testLogOut() 
    {
        $user = factory(User::class)->create();

        $this->actingAs($user, 'api')->visitRoute('auth.logout');

        $this->assertTrue(!Auth::check());
    }
}   
