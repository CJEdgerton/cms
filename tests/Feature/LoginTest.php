<?php

namespace Tests\Feature;
use App\User;
use App\PendingUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    private function createPendingUser()
    {
        return [
            'last_name'             => str_random(10),
            'first_name'            => str_random(15),
            'email'                 => str_random(5) . '@' . str_random(5) . '.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ];
    }

    /** @test */
    public function a_registered_user_will_go_to_the_home_screen()
    {
        $admin_user     = create('App\User', ['is_admin' => 1]);
        $non_admin_user = create('App\User', ['is_admin' => 0]);

        $this->post( route('login', [
            'email' => $admin_user->email,
            'password' => 'secret',
        ]))->assertRedirect('home');

        $this->post( route('login', [
            'email'    => $non_admin_user->email,
            'password' => 'secret',
        ]))->assertRedirect('home');
    }

    /** @test */
    public function a_pending_user_cannot_login()
    {
        $pending_user = create('App\PendingUser');

        $this->post( route('login', [
            'email'    => $pending_user->email,
            'password' => 'secret',
        ]));

        $this->get('/login')
            ->assertSee('Your registration is still pending approval.');
    }

}
