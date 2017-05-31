<?php 

namespace App\Utilities;

use App\Page; 

class PageHelpers 
{
	/**
	 * Returns string the path name
	 * @param  String
	 * @param  String|null
	 * @return String
	 */
	public function preparePath( String $name, String $path = null )
	{
		// If the path was left blank, set it to the name of the page
		if ( is_null($path) ) {
			return  $this->createPathForPage( str_slug( $name ) );
		}

		return '/' . $this->removeLeadingAndTrailingSlashes($path);	
	}

	public function removeLeadingAndTrailingSlashes($string)
	{
		$array = str_split($string);
		$end   = count($array) - 1;

		if ($array[0] === '/')
			unset($array[0]);

		if ($array[$end] === '/')
			unset($array[$end]);

		return implode("", $array);

	}

	protected function createPathForPage(String $slug)
	{
		$faker = \Faker\Factory::create();
		$levels = rand(1,2);
		$path = '/';

		for( $i = 0; $i < $levels; $i++ )
		{
			$path = $path . $faker->word . '/';
		}

		$path = $path . $slug;

		return strtolower($path);
	}


}