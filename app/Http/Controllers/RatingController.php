<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * create/update rating
     */
    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,10',
        ]);

        // Check if user has rated movie
        $existingRating = Rating::where('user_id', Auth::id())
            ->where('movie_id', $movie->id)
            ->first();

        if ($existingRating) {
            $existingRating->update($validated);
            $message = 'Rating updated successfully';
        } else {
            Rating::create([
                'user_id' => Auth::id(),
                'movie_id' => $movie->id,
                'rating' => $validated['rating'],
                'review' => $validated['review'] ?? null,
            ]);
            $message = 'Rating added successfully';
        }

        // Update average rating
        $avgRating = Rating::where('movie_id', $movie->id)->avg('rating');
        $movie->update(['average_rating' => round($avgRating, 1)]);

        return redirect()->back();
    }

    /**
     * Get user's rating of a movie
     */
    public function show(Movie $movie)
    {
        $rating = Rating::where('user_id', Auth::id())
            ->where('movie_id', $movie->id)
            ->first();

        return response()->json($rating);
    }
}
