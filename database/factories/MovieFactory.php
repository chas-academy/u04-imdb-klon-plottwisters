<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->word()),
            'description' => fake()->text($maxNbChars = 300),
            'trailer_url' => 'https://youtu.be/YJserno8tyU?si=VBNT6UkTRKbAs6TW',
            'image_url' => 'https://posters.movieposterdb.com/22_01/2021/8721424/t_8721424_ac84bfc0.jpg',
            'director_name' => fake()->name()
        ];
    }
}
