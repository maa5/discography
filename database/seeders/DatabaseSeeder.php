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
        Artist::factory(5)
            ->has(
                LP::factory(rand(1, 5))
                    ->has(
                        Song::factory(rand(1, 5))
                            ->has(Author::factory(rand(1, 5)))
                    )
            )
            ->create();
    }
}
