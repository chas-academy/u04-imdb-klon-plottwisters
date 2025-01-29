<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::factory()->count(5)->create();

        Genre::factory()->create(
            ['genre_name' => 'Horror']
        );
        Genre::factory()->create(
            ['genre_name' => 'Family']
        );
    }
}
