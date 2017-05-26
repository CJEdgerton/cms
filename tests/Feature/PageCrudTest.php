<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageCrudTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function an_authorized_user_can_view_a_thread()
    {
        $this->withExceptionHandling();
        
		$admin       = create('App\User', ['is_admin' => 1]);
		$normal_user = create('App\User', ['is_admin' => 0]);

		$admins_page       = create('App\Page', ['created_by' => $admin->id]);
		$normal_users_page = create('App\Page', ['created_by' => $normal_user->id]);

		$this->signIn($normal_user);
		$this->get( route('pages.show', ['id' => $admins_page->id]) )
			->assertStatus(403);

		$this->signIn($admin);
		$this->get( route('pages.show', ['id' => $normal_users_page->id]) )
			->assertSee($normal_users_page->name);

    }
}
