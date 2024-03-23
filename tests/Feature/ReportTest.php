<?php

namespace Tests\Feature;

use App\Models\Artist;
use App\Models\Author;
use App\Models\LP;
use App\Models\Song;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_returns_view_with_report_data(): void
    {
        // Create LPs with associated artists and songs

        $artist1 = Artist::factory()->create();
        $artist2 = Artist::factory()->create();

        $lp1 = LP::factory()->create(['artist_id' => $artist1->id]);
        $lp2 = LP::factory()->create(['artist_id' => $artist2->id]);

        $song1 = Song::factory()->create(['l_p_id' => $lp1->id]);
        $song2 = Song::factory()->create(['l_p_id' => $lp1->id]);
        $song3 = Song::factory()->create(['l_p_id' => $lp2->id]);

        $author1 = Author::factory()->create();
        $author2 = Author::factory()->create();
        $author3 = Author::factory()->create();

        $song1->authors()->attach($author1);
        $song2->authors()->attach($author2);
        $song3->authors()->attach($author3);

        $response = $this->get(route('report.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.report.index');

        $lps = $response->viewData('lps');

        $response->assertViewHas('lps', function ($lps) use ($lp1, $lp2) {
            return $lps->contains('id_lp', $lp1->id) &&
                $lps->contains('id_lp', $lp2->id);
        });








        // Call the index method from ReportController


        // Assert the response is successful


        // Assert that the view contains LP data
        /*;*/
    }
}
