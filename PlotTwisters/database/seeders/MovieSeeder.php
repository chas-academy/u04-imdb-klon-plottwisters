<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Database\Factories\GenreFactory;
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


    }
}
