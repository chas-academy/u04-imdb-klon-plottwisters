<?php

namespace App\Http\Controllers;

use \App\Models\Movie;
use \App\Models\User;
use \App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function pendingReviews()
    {
        $reviews = Rating::whereNull('approved_at')->get();
        return view('admin.review.index', compact('reviews'));
    }

    public function approveReview(Rating $rating)
    {
        $rating->update(['approved_at' => now()]);
        return redirect()->back()->with('success', 'Review approved.');
    }

    public function deleteReview(Rating $rating)
    {
        $rating->delete();
        return redirect()->back()->with('success', 'Review deleted.');
    }

    public function moviesIndex()
    {
        $movies = Movie::paginate(9);
        return view('admin.movies.index', compact('movies'));
    }

    public function addMovie()
    {
        return view('admin.movies.add'); //kan ändras beroende på vad view heter
    }

    public function storeMovie(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trailer_url' => 'nullable|url|',
            'image_url' => 'nullable|url|',
            'director_name' => 'nullable|string|max:255',
        ]);

        Movie::create($validated);
    }

    public function editMovie(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function updateMovie(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trailer_url' => 'nullable|url|',
            'image_url' => 'nullable|url|',
            'director_name' => 'nullable|string|max:255',
        ]);

        $movie->update($validated);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated.');
    }

    public function deleteMovie(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);
       
        $user->name = $validated['name'];
        $user->email = $validated['email'];

         if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();
      
        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }

    public function usersIndex(Request $request)
    {
 
        $editingUserId = $request->input('editingUserId');

    
        $users = User::all();

   
        return view('admin.users.index', compact('users', 'editingUserId'));
    }

    public function toggleUserRole(User $user)
{
    $user->is_admin = !$user->is_admin;
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User role updated.');
}

}
