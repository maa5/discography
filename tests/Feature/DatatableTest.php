<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\LP;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatatableTest extends TestCase
{
    use RefreshDatabase;

    /**
     *  Test returns correct json for LP datatable
     */
    public function test_lp_returns_correct_json()
    {
        $artist = Artist::factory()->create();

        $lp1 = LP::factory()->create([
            'created_at' => now()->subDays(2),
            'artist_id' => $artist->id
        ]);

        $lp2 = LP::factory()->create(
            [
                'created_at' => now()->subDays(1),
                'artist_id' => $artist->id
            ]
        );

        $response = $this->getJson(route('datatable.lp'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'description', 'artist', 'created_at', 'updated_at', 'url']
            ]
        ]);

        $response->assertSeeInOrder([$lp2->id, $lp1->id]);

        $response->assertJsonFragment([
            'url' => route('lps.show', $lp1->slug)
        ]);

        $response->assertJsonFragment([
            'url' => route('lps.show', $lp2->slug)
        ]);
    }

    /**
     *  Test returns correct json for Artist datatable
     */
    public function test_artist_returns_correct_json()
    {
        $artist1 = Artist::factory()->create();
        $artist2 = Artist::factory()->create();

        $response = $this->getJson(route('datatable.artist'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'description', 'created_at', 'updated_at', 'url']
            ]
        ]);

        $response->assertJsonFragment([
            'url' => route('artists.show', $artist1->slug)
        ]);

        $response->assertJsonFragment([
            'url' => route('artists.show', $artist2->slug)
        ]);
    }
}
