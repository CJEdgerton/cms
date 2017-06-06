<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UploadImageTest extends TestCase
{
    /** @test */
    public function uploads_an_image_and_returns_full_path()
    {
        $this->signIn();

        $response = $this->json('POST', route('utilities.upload_image'), [
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $path =  str_replace("http://localhost/", "", asset($response->original) ); 

        // Assert the file was stored...
        Storage::disk('public')->assertExists($path);

        // Delete the test file
        Storage::disk('public')->delete($path);

        // Assert a file does not exist...
        Storage::disk('public')->assertMissing($path);
    }
}
