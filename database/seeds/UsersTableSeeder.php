<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	\App\User::create([
			'is_admin'   => 1,
			'last_name'  => 'Vader',
			'first_name' => 'Darth',
			'email'      => 'vader@deathstar.com',
			'password'   => bcrypt('password'),
    	]);
    	
    	factory(App\User::class, 10)->create();
    }
}
