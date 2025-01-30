<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listOfmovies = Movie::all();
        return view('movies.index', compact('listOfmovies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trailer_url' => 'nullable|url',
            'image_url' => 'nullable|url',
            'director_name' => 'nullable|string|max:255',
        ]);

        // Create a new movie
        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'trailer_url' => $request->trailer_url,
            'image_url' => $request->image_url,
            'director_name' => $request->director_name,
        ]);

        // Redirect to the movies list with success message
        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
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
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // Delete the movie
        $movie->delete();

        // Redirect to the movies list with success message
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}
