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
		$allSuggestions = array();

		foreach($words as $word)
		{
			if( count( $wordSuggestions = $this->returnSuggestions($word) ) )
				$allSuggestions[$word] = $wordSuggestions;
		}

		$return_format = [
			"words" => $allSuggestions
		];

		return json_encode($return_format);	
	}

	public function returnSuggestions(String $word)
	{
		$suggestions = array();

        // Suggests possible words in case of misspelling
        $config_dic = pspell_config_create('en');

        // Ignore words under 2 characters
        pspell_config_ignore($config_dic, 2);

        // Configure the dictionary
        pspell_config_mode($config_dic, PSPELL_FAST);
        $dictionary = pspell_new_config($config_dic);

        if (!pspell_check($dictionary, $word)) {
            $suggestions = pspell_suggest($dictionary, $word);
        }

        return $suggestions;	
	}
}