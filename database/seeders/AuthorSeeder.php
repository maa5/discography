<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = Song::all();

        $songs->each(function ($song) {
            $authors = Author::factory(rand(1, 3))->create();
            $song->authors()->attach($authors->pluck('id'));
        });
    }
}
