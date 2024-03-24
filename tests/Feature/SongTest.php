<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\LP;
use App\Models\Song;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SongTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if model song exists in database
     */
    public function test_song_model_exist_in_database(): void
    {
        $artist = Artist::factory()->create();

        $lp = LP::factory()->create(['artist_id' => $artist->id]);

        $song = Song::factory()->create(['l_p_id' => $lp->id]);

        $this->assertModelExists($song);
    }
}
