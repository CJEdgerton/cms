<?php 

namespace App\Utilities;

class SpellChecker
{

	private $return_format = '
		{
		  "words": {
		     "misspelled1": ["suggestion1", "suggestion2"],
		     "misspelled2": ["suggestion1", "suggestion2"]
		  }
		}
	';

	public function spellCheck(Array $words)
	{
		$suggestions = array();

		foreach($words as $word)
		{
			array_push($suggestions, $this->returnSuggestions($word));
		}

		dd($suggestions);
	}

	public function returnSuggestions($string)
	{
		$suggestions = array();

        // Suggests possible words in case of misspelling
        $config_dic = pspell_config_create('en');

        // Ignore words under 2 characters
        pspell_config_ignore($config_dic, 2);

        // Configure the dictionary
        pspell_config_mode($config_dic, PSPELL_FAST);
        $dictionary = pspell_new_config($config_dic);

        if (!pspell_check($dictionary, $string)) {
            $suggestions = pspell_suggest($dictionary, $string);
        }

        return $suggestions;	
	}
}