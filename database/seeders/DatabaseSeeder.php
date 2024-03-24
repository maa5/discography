<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Artist;
use App\Models\Author;
use App\Models\LP;
use App\Models\Song;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Create 5 Artists
        $artists = Artist::factory(5)->create();

        $artists->each(function ($artist) {
            // For each artist, create between 1 or 3 LPs
            $artist->lps()->saveMany(LP::factory(rand(1, 3))->make())->each(function ($lp) {
                // For each LPS, create between 1 or 5 songs
                $lp->songs()->saveMany(Song::factory(rand(1, 5))->make())->each(function ($song) {
                    // For each song, attach at authors
                    $author = Author::factory(rand(1, 4))->create();
                    $song->authors()->attach($author);
                });
            });
        });
    }
}
