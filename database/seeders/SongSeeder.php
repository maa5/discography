<?php

namespace Database\Seeders;

use App\Models\LP;
use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lps = LP::all();

        $lps->each(function ($lp) {
            Song::factory(rand(1, 5))->create(['l_p_id' => $lp->id]);
        });
    }
}
