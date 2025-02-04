<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        $genres = Genre::paginate(18);
        return view('genre.all', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

Genre::create(['genre_name' => $request->name]);



        return redirect()->route('genre.index');


    }

    /**
     * Display the specified resource.
     */
 public function show(Genre $genre)
    {
        // Show a single genre
        return view('genre.show', compact('genre'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
       return view('genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $genre->update([
                    'genre_name' => $request->genre_name,
                ]);

                // Redirect to the genre list with success message
                return redirect()->route('genre.index')->with('success', 'genre updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        //
    }
}
