<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
        /**
     * Show the form for creating a new resource.
     */
    // public function create(): View
    // {
    //    return view('movies.show');
    // }

    // Create review
    public function store(Request $request, Movie $movie)
    {

        $request->validate([
            'title' => 'required|string|max:1000',
            'description' => 'required|string|max:4000',
        ]);
       
        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
            'title' => $request->title,
            'description' => $request->description,

        ]);

        return redirect()->route('movies.show', $movie->id); 
    }

    // Show reviews

    public function index(Movie $movie)
    {

        $reviews = Review::where('movie_id', $movie->id)->latest()->get();
        $movie = $movie;
        // return response()->json($reviews);
        
        return view('movies.show', compact('reviews', 'movie'));
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
