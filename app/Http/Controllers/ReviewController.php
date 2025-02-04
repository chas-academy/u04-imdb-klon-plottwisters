<?php

namespace App\Http\Controllers;

use App\Models\Review; 
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class ReviewController extends Controller
{
    // create new review

    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'review' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(), 
            'movie_id' => $movie->id, 
            'review' => $validated['review'],
        ]);

        return redirect()->route('home'); // might have to change redirects
    }
}
