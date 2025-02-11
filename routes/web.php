<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\ReviewController;
use App\Models\Movie;
use App\Models\Review;
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



//#################### MOVIE ##################

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

Route::get('/movies/{id}/reviews', function () {
    $movies = Movie::all();
    return view('movies.reviews');
})->middleware(['auth', 'verified'])->name('reviews');

Route::post('/addmovie', [MovieController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('movies.store');



// Route::get('/movies/{id}/review/create', function() {
//     $movies = Movie::all();
//     return view('movies.show');
// })->middleware(['auth', 'verified'])->name('createReview');


//#################### REVIEWS ##################

Route::get('/movies/{movie}', [ReviewController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('movies.show');

Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('reviews');

Route::get('/admin/editUser', function () {
    return view('admin.edit');
});




//####################GENRE##################

Route::get('/genre', [GenreController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('genre.index');

Route::get('/genre/create', [GenreController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('genre.create');


Route::post('/genre', [GenreController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('genre-storing-route');

Route::get('/genre/{genre}', [GenreController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('genre.show');


Route::get('/genre/{genre}/edit', [GenreController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('genre.edit');


Route::put('/genre/{genre}', [GenreController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('genre.update');
Route::delete('/genre/{genre}', [GenreController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('genre.destroy');

Route::post('/profile/update-picture', [ProfileController::class, 'updatePicture'])
    ->middleware(['auth', 'verified'])
    ->name('profile.update-picture');


 //####################Watchlist##################
Route::middleware(['auth'])->group(function () {


    Route::post('/watchlists', [WatchlistController::class, 'store'])->name('watchlists.store');
    Route::get('/watchlists/create', [WatchlistController::class, 'create'])->middleware('auth')->name('watchlists.create');
    Route::get('/watchlists', [WatchlistController::class, 'index'])->middleware('auth')->name('watchlists.index');
    Route::get('/watchlists/{watchlist}', [WatchlistController::class, 'show'])->name('watchlists.show');
    Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

    Route::delete('/watchlists/{watchlist}', [WatchlistController::class, 'delete'])->name('watchlists.delete');
    Route::post('/watchlists/movies', [WatchlistController::class, 'addMovie'])->name('watchlists.addMovie');
    Route::delete('/watchlists/{watchlist}/movies/{movie}', [WatchlistController::class, 'removeMovie'])
        ->name('watchlists.removeMovie');
});


require __DIR__ . '/auth.php';
