<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show user
    public function show(User $user)
    {
        return view('users.show', compact('user')); //'users.show' och andra views kan ändras till korrekt view-namn för platsen där användarens profil visas
    }

    // Edit user
    public function edit()
    {
        return view('users.edit', ['user' => Auth::user()]);
    }

    // Update user
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

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

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy(User $user)
    {
        if ($user->id !== Auth::id() && !Auth::user()->is_admin) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('home')->with('success', 'User deleted successfully.');
    }

    public function index()
    {
        if (!Auth::user()->is_admin) {
            return redirect()->back()->with('error', 'Unauthorized.');

        }

        $user = User::paginate(9);
        return view('user.index', compact('users'));
    }
}
