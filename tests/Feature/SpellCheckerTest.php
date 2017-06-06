<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpellCheckerTest extends TestCase
{
    protected $words = ['covfefe', 'soemthing', 'correct'];

    /** @test */
    public function returns_associative_array_of_suggestions()
    {
        $checker = new \App\Utilities\SpellChecker;
        $suggestions = $checker->spellCheck($this->words, "array");

        $this->assertTrue( array_key_exists( $this->words[0], $suggestions['words'] ) );
        $this->assertTrue( array_key_exists( $this->words[1], $suggestions['words'] ) );
        $this->assertFalse( array_key_exists( $this->words[2], $suggestions['words'] ) );
    }

    /** @test */
    public function returns_json_object_of_suggestions()
    {
        $this->signIn();
        $post_data = [ 'words' => implode(',', $this->words) ];

        // ** Note ** route may change
        $response = $this->post(route('pages.spell_check'), $post_data);
        $response->assertStatus(200);

        $this->assertTrue( str_contains($response->original, $this->wrapStringInQuotes( $this->words[0] ) ) );
        $this->assertTrue( str_contains($response->original, $this->wrapStringInQuotes( $this->words[1] ) ) );
        $this->assertFalse( str_contains($response->original, $this->wrapStringInQuotes( $this->words[2] ) ) );
    }

    // Need this to test for words in json response since they are wrapped in quotes
    private function wrapStringInQuotes($string)
    {
        return '"' . $string . '"'; 
    }
}
