<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/search', function () {
    $query = request('search');
    $movies = Movie::where('title', 'like', '%' . $query . '%')->get();
    
    return view('search', compact('movies', 'query')); 
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(MovieController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});
Route::get('/create', [MovieController::class, 'create'])
->middleware(['auth', 'verified'])
->name('movies.create');

Route::post('/', [MovieController::class, 'store'])
->middleware(['auth', 'verified'])
->name('movies.show');

Route::get('/movies/{movie}', [MovieController::class, 'show'])
->middleware(['auth', 'verified'])
->name('movies.show');

Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])
->middleware(['auth', 'verified'])
->name('movies.edit');

Route::put('/movies/{movie}', [MovieController::class, 'update'])
->middleware(['auth', 'verified'])
->name('movies.update');

Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])
->middleware(['auth', 'verified'])
->name('movies.destroy');

require __DIR__.'/auth.php';
