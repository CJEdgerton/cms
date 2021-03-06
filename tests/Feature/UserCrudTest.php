<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCrudTest extends TestCase
{
    use DatabaseTransactions;

    protected function signInAnAdmin()
    {
        $admin = create('App\User', ['is_admin' => 1]);
        $this->signIn($admin);

        return $admin;
    }

    /** @test */
    public function user_must_be_authenticated_to_manage_users()
    {
        $this->withExceptionHandling();
        $user = create('App\User');

    	$this->get(route('users.index'))
    		->assertRedirect('login');
        
    	$this->get(route('users.create'))
    		->assertRedirect('login');
        
    	$this->post(route('users.store'))
    		->assertRedirect('login');
        
    	$this->get(route('users.edit', ['id', $user->id]))
    		->assertRedirect('login');
        
    	$this->patch(route('users.update', ['id', $user->id]))
    		->assertRedirect('login');
        
    	$this->delete(route('users.destroy', ['id', $user->id]))
    		->assertRedirect('login');
    }

    /** @test */
    public function user_must_be_an_admin_to_manage_users()
    {
        $this->withExceptionHandling();
		$user        = create('App\User');
		$normal_user = create('App\User', ['is_admin' => 0]);

        $this->signIn($normal_user);

    	$this->get(route('users.index'))
    		->assertRedirect('home');
        
    	$this->get(route('users.create'))
    		->assertRedirect('home');
        
    	$this->post(route('users.store'))
    		->assertRedirect('home');
        
    	$this->get(route('users.edit', ['id' => $user->id]))
    		->assertRedirect('home');
        
    	$this->patch(route('users.update', ['id' => $user->id]))
    		->assertRedirect('home');
        
    	$this->delete(route('users.destroy', ['id' => $user->id]))
    		->assertRedirect('home');
    }

    /** @test */
    public function an_admin_can_perform_crud_on_users()
    {

        // $this->withExceptionHandling();

        $user  = make('App\User');
        $user->confirm_password = $user->password;
        $user->makeVisible(['password', 'remember_token']);
        $admin = create('App\User', ['is_admin' => 1]);
        $this->signIn($admin);

        // Index
        $this->get(route('users.index'))
            ->assertSee('Manage Users');
        
        // Create 
        $this->get(route('users.create'))
            ->assertSee('Create User');
       
        // Store 
        $this->post(route('users.store'), $user->toArray());
        $this->assertDatabaseHas('users', ['email' => $user->email]);

        // Create User
        $user  = create('App\User');
        $user->confirm_password = $user->password;
        $user->makeVisible(['password', 'remember_token']);

        // Edit
        $this->get( route('users.edit', ['id' => $user->id]) )
            ->assertSee('Edit User');
        
        // Update
        $user->email = 'updated@email.com';
        $this->patch(
            route('users.update', ['id' => $user->id]), 
            $user->toArray()
        );
        $this->assertDatabaseHas('users', ['email' => $user->email]);
        
        // Delete
        $this->delete(route('users.destroy', ['id' => $user->id]))
            ->assertRedirect( route('users.index') );

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
            'deleted_at' => null,
        ]);

    }

    /** @test */
    public function an_admin_can_restore_a_deleted_user()
    {
        $admin = create('App\User', ['is_admin' => 1]);
        $user  = create('App\User', [
            'is_admin'   => 0, 
            'deleted_at' => Carbon::now()
        ]);

        $this->signIn($admin);

        $this->get( route('users.restore', ['id' => $user->id]) )
            ->assertRedirect( route('users.edit', ['id' => $user->id]) );

        $this->assertDatabaseHas('users',[
            'id'         => $user->id,
            'deleted_at' => null,
        ]);
    }

    /** @test */
    public function a_non_admin_cannot_restore_a_deleted_user()
    {
        $this->withExceptionHandling();
        $user       = create('App\User', ['is_admin' => 0]);
        $other_user = create('App\User', [
            'is_admin'   => 0, 
            'deleted_at' => Carbon::now()
        ]);

        $this->signIn($user);

        $this->get( route('users.restore', ['id' => $other_user->id]) )->assertRedirect('home');
    }

}
