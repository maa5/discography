<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\LP;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artists = Artist::all();

        $artists->each(function ($artist) {
            LP::factory(rand(1, 3))->create(['artist_id' => $artist->id]);
        });
    }
}
