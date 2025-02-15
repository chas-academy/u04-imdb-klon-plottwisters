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

        return redirect()->route('reviews'); 
    }

    // Show reviews

    public function index(Movie $movie)
    {

        $reviews = Review::where('movie_id', $movie->id)->latest()->get();
        $movie = $movie;
        // return response()->json($reviews);
        
        
        return view('movies.show', compact('reviews', 'movie'));
    }

    // public function show(Review $review, string $id)
    // {
    //     // Show a single movie
    //     $review = Review::findorFail($id);
    //     dd($review);
    //     return view('movies.show', compact('review'));
    // }

    // Update

    public function update(Request $request, Review $review, Movie $movie)
    {
        $movie = Movie::findOrFail($request->movie_id);
        // dd($movie);
       $review = Review::findOrFail($request->id);
    //    dd($review);
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'unauthorized');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:1000',
            'description' => 'required|string|max:4000',
        ]);
        

        $review->update($validated);

        return redirect()->route('movies.show', $movie->id);
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
