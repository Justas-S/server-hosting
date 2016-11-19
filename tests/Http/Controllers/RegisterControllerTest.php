<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;


class RegisterControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testForm()
    {
        $this
            ->visitRoute('auth.register')
            ->seeRouteIs('auth.register');
    }

    public function testRegistration()
    {
        Session::start();
        $this->route('POST', 'auth.postRegister', [], [
                '_token'    => Session::token(),
                'username'  => 'NonExistantUserHopefully',
                'password'  => 'fieoamergaerg654fraer.aerg',
                'password_confirmation' => 'fieoamergaerg654fraer.aerg',
                'email'     => 'example@example.com'
            ]);
        $user = User::where('username', 'NonExistantUserHopefully')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('fieoamergaerg654fraer.aerg', $user->password));
        $this->assertTrue($user->email == 'example@example.com');
    }
}   
