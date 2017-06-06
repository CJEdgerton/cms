<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpellCheckerTest extends TestCase
{
    /** @test */
    public function returns_associative_array_of_suggestions()
    {
        $words = ['covfefe', 'soemthing', 'correct'];

        $checker = new \App\Utilities\SpellChecker;
        $suggestions = $checker->spellCheck(['covefefe', 'heer', 'something'], "array");

        $this->assertTrue( array_key_exists( 'covefefe', $suggestions['words'] ) );
        $this->assertTrue( array_key_exists( 'heer', $suggestions['words'] ) );
        $this->assertFalse( array_key_exists( 'something', $suggestions['words'] ) );
    }

    /** @test */
    public function returns_json_object_of_suggestions()
    {
        $this->signIn();

        $words = ['covfefe', 'soemthing', 'correct'];
        $post_data = [ 'words' => implode(',', $words) ];


        // ** Note ** route may change
        $response = $this->post(route('pages.spell_check'), $post_data);
        $response->assertStatus(200);

        $suggestions = $response->original;

        $this->assertTrue( str_contains($suggestions, '"covfefe"') );
        $this->assertTrue( str_contains($suggestions, '"soemthing"') );
        $this->assertFalse( str_contains($suggestions, '"correct"') );
    }
}
