<?php

namespace Tests\Feature;
use App\User;
use App\PendingUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationTest extends TestCase
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
    public function registration_form_creates_a_pending_user()
    {
        $pending_user = $this->createPendingUser();

        $this->post(route('register'), $pending_user)
            ->assertRedirect('/');

        $this->assertDatabaseHas('pending_users', ['email' => $pending_user['email']] );
    }

    /** @test */
    public function an_admin_can_grant_access_to_a_pending_user()
    {
        $this->withExceptionHandling();

        $admin_user     = create('App\User', ['is_admin' => 1]);
        $non_admin_user = create('App\User', ['is_admin' => 0]);
        $pending_user   = PendingUser::create($this->createPendingUser());

        $this->signIn($non_admin_user);
        $this->put( route('pending_users.approve_registration', ['id' => $pending_user->id]))
            ->assertRedirect('home');

        $this->signIn($admin_user);
        $this->put( route('pending_users.approve_registration', ['id' => $pending_user->id]))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', ['email' => $pending_user->email]);
        $this->assertDatabaseMissing('pending_users', ['email' => $pending_user->email]);
    }
}
