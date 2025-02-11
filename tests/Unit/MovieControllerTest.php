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
        // Create some movies
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
        $response->assertSee($movie1->image_url) ;
        $response->assertSee($movie2->image_url);
    }

    public function test_store_creates_movie()
        {
            // Create and authenticate a user
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

}
