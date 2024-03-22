<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Artist;
use App\Models\LP;
use Illuminate\Support\Str;

class ArtistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if model artist exists in database
     */
    public function test_artist_model_exist_in_database()
    {
        $artist = Artist::factory()->create();

        $this->assertModelExists($artist);
    }

    /**
     * Test returns a view with a list of artists
     */
    public function test_returns_view_with_artists()
    {
        $artists = Artist::factory(5)->create();

        $response = $this->get(route('artists.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.artists.index');
        $response->assertViewHas('artists', $artists);
    }

    /**
     * Test returns a view an artist with their lps
     */
    public function test_returns_view_with_artist_lps()
    {
        Artist::factory()->has(LP::factory(2))->create();
        $artist = Artist::first();

        $response = $this->get(route('artists.lps', ['slug' => $artist->slug]));

        $response->assertStatus(200);
        $response->assertViewIs('pages.artists.lps');
        $response->assertViewHas('artist_name', $artist->name);
        $response->assertViewHas('lps', $artist->lps);
    }

    /**
     * Test creates new artist
     */
    public function test_creates_new_artist()
    {
        $name = 'Test Artist';

        $data = [
            'slug' => Str::slug($name),
            'name' => $name,
            'description' => 'Test Description'
        ];

        $response = $this->post(route('artists.store'), $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('artists', $data);
    }

    /**
     * Test returns view with specific artist
     */
    public function test_returns_view_with_artist()
    {
        $artist = Artist::factory()->create();

        $response = $this->get(route('artists.show', $artist->slug));

        $response->assertStatus(200);
        $response->assertViewIs('pages.artists.show');
        $response->assertViewHas('artist', $artist);
    }

    /**
     * Test updates existing artist
     */
    public function test_updates_artist()
    {
        $artist = Artist::factory()->create();
        $newData = [
            'name' => 'Updated Artist Name',
            'description' => 'Updated Description',
        ];

        $response = $this->put(route('artists.update', $artist->id), $newData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('artists', $newData);
    }

    /**
     * Test delete existing artist
     */
    public function test_deletes_artist()
    {
        $artist = Artist::factory()->create();

        $response = $this->delete(route('artists.destroy', $artist->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('artists', ['id' => $artist->id]);
    }
}
