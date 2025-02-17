<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_store_review(): void
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $reviewData = [
            'title' => 'Review Title',
            'description' => 'Review Description',
        ];

        $response = $this->actingAs($user)
        ->post(route('reviews', $movie->id), $reviewData);

        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'title' => 'Review Title',
            'description' => 'Review Description',
        ]);

        $response->assertRedirect(route('movies.show', $movie->id));

    }

}
