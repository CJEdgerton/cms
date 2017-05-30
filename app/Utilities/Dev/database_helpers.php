<?php

function createPathForPage(Faker\Generator $faker, String $slug)
{
	$levels = rand(1,2);
	$path = '/';

	for( $i = 0; $i < $levels; $i++ )
	{
		$path = $path . $faker->word . '/';
	}

	$path = $path . $slug;

	return $path;
}

function returnRandomId($model)
{
	return $model::all()->random()->id;
}