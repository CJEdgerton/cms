<?php 

namespace App\Utilities;

class SpellChecker
{
	protected $dictionary;

	public function __construct()
	{
        // Suggests possible words in case of misspelling
        $dictionary = pspell_config_create('en');

        // Ignore words under 2 characters
        pspell_config_ignore($dictionary, 2);

        // Configure the dictionary
        pspell_config_mode($dictionary, PSPELL_FAST);

        $this->dictionary = pspell_new_config($dictionary);
	}

	public function spellCheck(Array $words, String $return_format = "json")
	{
		$allSuggestions = array();

		foreach($words as $word)
		{
			if( count( $wordSuggestions = $this->returnSuggestions($word) ) )
				$allSuggestions[$word] = $wordSuggestions;
		}

		// Tiny MCE requires a response in this format
		$return_array = [ "words" => $allSuggestions ];

		if ($return_format === "json")
			return json_encode($return_array);	

		return $return_array;	
	}

	public function returnSuggestions(String $word)
	{
		$suggestions = array();

        if (!pspell_check($this->dictionary, $word))
            $suggestions = pspell_suggest($this->dictionary, $word);

        return $suggestions;	
	}
}