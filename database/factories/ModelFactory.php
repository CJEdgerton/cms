<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
		'is_admin'       => $faker->boolean,
		'last_name'      => $faker->lastName,
		'first_name'     => $faker->name,
		'email'          => $faker->unique()->safeEmail,
		'password'       => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
	$name   = $faker->sentence;
	$path   = (new App\Utilities\PageHelpers)->preparePath($name);
	$active = $faker->boolean();

    return [
		'name'         => $name,
		'path'         => $path,
		'description'  => $faker->paragraph,
		'main_content' => $faker->randomHtml(2,3),
		'created_at'   => $faker->dateTime(),
		'created_by'   => returnRandomId('App\User'),
		'active'       => $active, 
		'activated_at' => $active ? $faker->dateTime() : null,
		'activated_by' => $active ? returnRandomId('App\User') : null,
    ];
});
