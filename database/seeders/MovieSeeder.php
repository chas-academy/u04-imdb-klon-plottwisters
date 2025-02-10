<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;
use App\Models\Review;
use Database\Factories\Movie_GenreFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::factory()->count(20)->create();

        Genre::factory()->create(
            ['genre_name' => 'Horror']
        );
        Genre::factory()->create(
            ['genre_name' => 'Family']
        );
        Genre::factory()->create(
            ['genre_name' => 'Action']
        );
        Genre::factory()->create(
            ['genre_name' => 'Drama']
        );
        Genre::factory()->create(
            ['genre_name' => 'Comedy']
        );

        Movie_genre::factory()->count(20)->create();
        
        Review::factory()->count(5)->create();
    }
}
