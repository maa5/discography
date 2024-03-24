<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\LP;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class LPTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if model lp exists in database
     */
    public function test_lp_model_exist_in_database(): void
    {
        $artist = Artist::factory()->create();
        $lp = LP::factory()->create(['artist_id' => $artist->id]);

        $this->assertModelExists($lp);
    }

    /**
     * Test returns a view with a list of artists
     */
    public function test_returns_view_with_artists_in_lp(): void
    {
        $artists = Artist::factory(5)->create();

        $response = $this->get(route('lps.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.lps.index');
        $response->assertViewHas('artists', $artists);
    }

    /**
     * Test creates new lp
     */
    public function test_creates_new_lp(): void
    {
        $artist = Artist::factory()->create();

        $name = 'Test LP';
        $data = [
            'slug' => Str::slug($name),
            'name' => $name,
            'description' => 'Test LP Description',
            'artist_id' => $artist->id
        ];

        $response = $this->post(route('lps.store'), $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('l_p_s', $data);
    }

    /**
     * Test returns view with specific lp
     */
    public function test_returns_view_with_lp(): void
    {
        $artist = Artist::factory()->create();

        $name = 'Test LP';
        $data = [
            'slug' => Str::slug($name),
            'name' => $name,
            'description' => 'Test LP Description',
            'artist_id' => $artist->id
        ];

        $lp = LP::create($data);

        $response = $this->get(route('lps.show', $lp->slug));

        $response->assertStatus(200);
        $response->assertViewIs('pages.lps.show');
        $response->assertViewHas('lp', $lp);
    }

    /**
     * Test updates existing lp
     */
    public function test_updates_lp(): void
    {
        $artist1 = Artist::factory()->create();
        $artist2 = Artist::factory()->create();

        $name = 'Test LP';
        $data = [
            'slug' => Str::slug($name),
            'name' => $name,
            'description' => 'Test LP Description',
            'artist_id' => $artist1->id
        ];

        $lp = LP::create($data);

        $newData = [
            'name' => 'Updated LP Name',
            'description' => 'Updated LP Description',
            'artist_id' => $artist2->id
        ];

        $response = $this->put(route('lps.update', $lp->id), $newData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('l_p_s', $newData);
    }

    /**
     * Test delete existing lp
     */
    public function test_deletes_lp(): void
    {
        $artist = Artist::factory()->create();

        $name = 'Test LP';
        $data = [
            'slug' => Str::slug($name),
            'name' => $name,
            'description' => 'Test LP Description',
            'artist_id' => $artist->id
        ];

        $lp = LP::create($data);

        $response = $this->delete(route('lps.destroy', $lp->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('l_p_s', ['id' => $lp->id]);
    }
}
