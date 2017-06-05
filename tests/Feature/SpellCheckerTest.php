<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpellCheckerTest extends TestCase
{
    /** @test  */
    public function spellCheckArrayOfWords()
    {
        $this->signIn();

        $faker = \Faker\Factory::create();
        $words = $faker->words($nb = 3, $asText = false);

        $this->post(route('pages.spell_check'), $words)
            ->assertStatus(200);

    }
}
