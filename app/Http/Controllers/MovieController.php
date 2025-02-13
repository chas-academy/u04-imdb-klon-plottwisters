<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedGenre = $request->input('genre');

        if ($selectedGenre) {
            $movies = Movie::whereHas('genres', function ($query) use ($selectedGenre) {
                $query->where('id', $selectedGenre);
            })->paginate(18);
        } else {
            $movies = Movie::paginate(20);
        }

        $featuredMovie = Movie::where('is_featured', true)->first() ?? null;

        $genres = Genre::all(); // Fetch all available genres

        return view('home', compact('movies', 'genres', 'selectedGenre', 'featuredMovie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all(); // Fetch all available genres
        return view('movies.create',  compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Validate the incoming request

            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trailer_url' => 'nullable|url',
            'image_url' => 'nullable|url',
            'director_name' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator, 'addmovie');
        }
        // Create a new movie
        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'trailer_url' => $request->trailer_url,
            'image_url' => $request->image_url,
            'director_name' => $request->director_name,
        ]);

        // Redirect to the movies list with success message
        return redirect()->route('home')->with('success', 'Movie added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        // Show a single movie
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        // Show edit form with the movie data
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trailer_url' => 'nullable|url',
            'image_url' => 'nullable|url',
            'director_name' => 'nullable|string|max:255',
        ]);

        // Update the movie
        $movie->update([
            'title' => $request->title,
            'description' => $request->description,
            'trailer_url' => $request->trailer_url,
            'image_url' => $request->image_url,
            'director_name' => $request->director_name,
        ]);

        // Redirect to the movies list with success message
        return redirect()->route('home')->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // Delete the movie
        $movie->delete();

        // Redirect to the movies list with success message
        return redirect()->route('home')->with('success', 'Movie deleted successfully!');
    }

    // Searching

    public function search(Request $request)
    {
        $query = $request->input('search');
        $movies = Movie::where('title', 'like', "%{query}%")->get();

        return view('movies.search-results', compact('movies'));
    }
}
