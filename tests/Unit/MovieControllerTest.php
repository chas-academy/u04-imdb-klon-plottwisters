<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\MovieController;
use App\Models\Movie;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_movies()
    {
        $user = User::factory()->create();
        $genre1 = Genre::factory()->create(['genre_name' => 'Action']);
        $genre2 = Genre::factory()->create(['genre_name' => 'Comedy']);

        $movie1 = Movie::factory()->create([
            'title' => 'Test Movie 1',
            'image_url' => 'https://example.com/image1.jpg'
        ]);

        $movie2 = Movie::factory()->create([
            'title' => 'Test Movie 2',
            'image_url' => 'https://example.com/image2.jpg'
        ]);

        $response = $this->actingAs($user)
            ->get('/movies');

        $response->assertStatus(200);
        $response->assertViewHas('movies');
        $response->assertViewHas('genres');
        $response->assertSee($movie1->image_url);
        $response->assertSee($movie2->image_url);
    }

    public function test_store_creates_movie()
    {
        $user = User::factory()->create();

        $movieData = [
            'title' => 'Test Movie',
            'description' => 'This is a test description.',
            'trailer_url' => 'https://example.com/trailer.mp4',
            'image_url' => 'https://example.com/image.jpg',
            'director_name' => 'John Doe',
        ];

        $response = $this->actingAs($user)
            ->post('/movies', $movieData);

        $response->assertRedirect();
        $this->assertDatabaseHas('movies', $movieData);
    }

    public function test_update_modifies_movie()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $updatedData = [
            'title' => 'Updated Movie Title',
            'description' => 'Updated description',
            'trailer_url' => 'https://example.com/updated-trailer.mp4',
            'image_url' => 'https://example.com/updated-image.jpg',
            'director_name' => 'Jane Smith',
        ];

        $response = $this->actingAs($user)
            ->put("/movies/{$movie->id}", $updatedData);

        $response->assertRedirect();
        $this->assertDatabaseHas('movies', $updatedData);
        $this->assertDatabaseMissing('movies', [
            'id' => $movie->id,
            'title' => $movie->title
        ]);
    }

    public function test_destroy_deletes_movie()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $response = $this->actingAs($user)
            ->delete("/movies/{$movie->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    }

    public function test_unauthenticated_user_cannot_access_movies()
    {
        // Test index
        $this->get('/movies')->assertRedirect('/login');

        $movie = Movie::factory()->create();

        // Test show
        $this->get("/movies/{$movie->id}")->assertRedirect('/login');
    }
}
