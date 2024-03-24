<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if model author exists in database
     */
    public function test_author_model_exist_in_database(): void
    {
        $author = Author::factory()->create();

        $this->assertModelExists($author);
    }
}
