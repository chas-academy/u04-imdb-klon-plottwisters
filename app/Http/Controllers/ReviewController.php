<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Create review

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

    // Show reviews

    public function index(Movie $movie)
    {
        $review = Review::where('movie_id', $movie->id)->latest()->get();

        return response()->json($review);
    }

    // Update

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'unauthorized');
        }

        $validated = $request->validate([
            'review' => 'required|string|max:1000',
        ]);

        $review->update($validated);

        return redirect()->back()->with('success', 'Review updated successfully!');
    }

    // Delete

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return redirect()->back()->with('error', 'unauthorized');
        }

        $review->delete();

        return redirect()->back()->with('sucess', 'Review deleted successfully');
    }
}
