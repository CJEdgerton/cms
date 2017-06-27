<?php

namespace Tests\Feature;

use App\Page;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageCrudTest extends TestCase
{
    use DatabaseTransactions;

    protected function createPage(User $user = null)
    {
    	if ( is_null( $user) )
	    	$page = create('App\Page', ['created_at' => Carbon::now()]);
	   	else
	    	$page = create('App\Page', ['created_at' => Carbon::now(), 'created_by' => $user->id]);

    	return $page;
    }

    protected function makePage(User $user = null)
    {
    	if ( is_null( $user) )
	    	$page = make('App\Page', ['created_at' => Carbon::now()]);
	   	else
	    	$page = make('App\Page', ['created_at' => Carbon::now(), 'created_by' => $user->id]);

    	return $page;
    }

    /** @test */
    public function user_must_be_authenticated_to_access_cms()
    {
    	// Add cms route here...
    	
        $this->withExceptionHandling();
        $page = $this->createPage();

    	$this->get(route('pages.index'))
    		->assertRedirect('login');
        
    	$this->get(route('pages.create'))
    		->assertRedirect('login');
        
    	$this->post(route('pages.store'))
    		->assertRedirect('login');
        
    	$this->get(route('pages.edit', ['id' => $page->id]))
    		->assertRedirect('login');
        
    	$this->patch(route('pages.update', ['id' => $page->id]))
    		->assertRedirect('login');
        
    	$this->delete(route('pages.destroy', ['id' => $page->id]))
    		->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_page()
    {
		$this->signIn();
		$page = $this->makePage();

		$this->get(route('pages.create'))
			->assertStatus(200);

		$this->post(route('pages.store'), $page->toArray());

		$latest_page = Page::latest()->first();

		$this->assertTrue( $page->name === $latest_page->name );


    }

    /** @test */
	public function non_admin_users_can_only_edit_their_own_pages()
	{
        $this->withExceptionHandling();

		$user       = create('App\User', ['is_admin' => 0]);
		$users_page = $this->createPage($user);

		$another_user       = create('App\User');
		$another_users_page = $this->createPage($another_user);

		$this->signIn($user);

		$this->get( route('pages.edit', ['id' => $users_page->id]) )
			->assertStatus(200);

		$this->patch( route('pages.update', ['id' => $users_page->id]), $users_page->toArray() )
			->assertRedirect(route('pages.edit', ['id' => $users_page->id]));

		$this->get( route('pages.edit', ['id' => $another_users_page->id]) )
			->assertStatus(403);

		$this->patch( route('pages.update', ['id' => $another_users_page->id]), $another_users_page->toArray()  )
			->assertStatus(403);
	}

    /** @test */
	public function admin_users_can_edit_all_pages()
	{
        $this->withExceptionHandling();

		$admin_user       = create('App\User', ['is_admin' => 1]);
		$admin_users_page = $this->createPage($admin_user);

		$another_user       = create('App\User');
		$another_users_page = $this->createPage($another_user);

		$this->signIn($admin_user);

		$this->get( route('pages.edit', ['id' => $admin_users_page->id]) )
			->assertStatus(200);

		$this->patch( route('pages.update', ['id' => $admin_users_page->id]), $admin_users_page->toArray() )
			->assertRedirect(route('pages.edit', ['id' => $admin_users_page->id]));

		$this->get( route('pages.edit', ['id' => $another_users_page->id]) )
			->assertStatus(200);

		$this->patch( route('pages.update', ['id' => $another_users_page->id]), $another_users_page->toArray()  )
			->assertRedirect(route('pages.edit', ['id' => $another_users_page->id]));
	}

    /** @test */
	public function non_admin_users_can_only_delete_their_own_pages()
	{
        $this->withExceptionHandling();

		$user       = create('App\User', ['is_admin' => 0]);
		$users_page = $this->createPage($user);

		$another_user       = create('App\User');
		$another_users_page = $this->createPage($another_user);

		$this->signIn($user);

		$this->delete( route('pages.destroy', ['id' => $users_page->id]) )
			->assertRedirect(route('pages.index'));
		$this->assertDatabaseMissing('pages', ['id' => $users_page->id]);

		$this->delete( route('pages.destroy', ['id' => $another_users_page->id]) )
			->assertStatus(403);
	}

    /** @test */
	public function admin_users_can_delete_any_page()
	{
        $this->withExceptionHandling();

		$admin_user       = create('App\User', ['is_admin' => 1]);
		$admin_users_page = $this->createPage($admin_user);

		$another_user       = create('App\User');
		$another_users_page = $this->createPage($another_user);

		$this->signIn($admin_user);

		$this->delete( route('pages.destroy', ['id' => $admin_users_page->id]) )
			->assertRedirect(route('pages.index'));
		$this->assertDatabaseMissing('pages', ['id' => $admin_users_page->id]);

		$this->delete( route('pages.destroy', ['id' => $another_users_page->id]) )
			->assertRedirect(route('pages.index'));
		$this->assertDatabaseMissing('pages', ['id' => $another_users_page->id]);
	}

    /** @test */
    public function a_page_owner_can_add_collaborators()
    {
		$user         = create('App\User', ['is_admin' => 0]);
		$collaborator = create('App\User', ['is_admin' => 0]);
		$users_page   = $this->createPage($user);

		$users_page->addCollaborator($collaborator);

		$this->assertDatabaseHas('page_collaborators', [
			'user_id' => $collaborator->id,
			'page_id' => $users_page->id,
		]);
    }
}
