<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/movies', [MovieController::class, 'index'])
->middleware(['auth', 'verified'])
->name('movies.index');

Route::get('/movies/create', [MovieController::class, 'create'])
->middleware(['auth', 'verified'])
->name('movies.create');

Route::post('/movies', [MovieController::class, 'store'])
->middleware(['auth', 'verified'])
->name('movies.store');

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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
