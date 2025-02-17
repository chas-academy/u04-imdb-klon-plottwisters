<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WatchlistController extends Controller
{
    use AuthorizesRequests;
    // Show all watchlists of the authenticated user
    public function index()
    {
        // Get the watchlists associated with the authenticated user
        $watchlists = Auth::user()->watchlists;


        return view('profile.edit', compact('watchlists'));
    }

    // Show a single watchlist
    public function show(Watchlist $watchlist)
    {
        // Ensure the user can only view their own watchlists
        $this->authorize('view', $watchlist);


        return view('watchlists.show', compact('watchlist'));
    }


    // Store a new watchlist
    public function store(Request $request)
    {
        // Validate the watchlist name
        $request->validate([
            'watchlist_name' => 'required|string|max:255',
        ]);

        // Create a new watchlist for the authenticated user
        Auth::user()->watchlists()->create([
            'watchlist_name' => $request->watchlist_name
        ]);


        return back()->with('success', 'Watchlist created!');
    }

    // Add a movie to a watchlist
    public function addMovie(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'watchlist_id' => 'required|exists:watchlists,id',
        ]);

        // Find the watchlist
        $watchlist = Watchlist::findOrFail($request->watchlist_id);

        // Ensure the authenticated user owns the watchlist
        if ($watchlist->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Attach the movie to the watchlist (without detaching existing movies)
        $watchlist->movies()->syncWithoutDetaching([$request->movie_id]);


        return back()->with('success', 'Movie added to watchlist!');
    }

    // Remove a movie from a watchlist
    public function removeMovie(Watchlist $watchlist, Movie $movie)
    {
        $this->authorize('update', $watchlist);

        $watchlist->movies()->detach($movie->id);

        return back()->with('success', 'Movie removed from watchlist!');
    }

    public function delete(Watchlist $watchlist)
    {
        // Ensure that the authenticated user owns the watchlist
        if ($watchlist->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Delete the watchlist
        $watchlist->delete();

        // Redirect back with success message
        return back()->with('success', 'Watchlist deleted successfully!');
    }

}
