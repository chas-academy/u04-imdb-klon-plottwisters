<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
use HasFactory;

protected $fillable = ['title', 'description', 'trailer_url', 'image_url', 'director_name'];

public function reviews() {
    return $this->hasMany(Review::class, 'movie_id');
}

public function ratings() {
    return $this->hasMany(Rating::class, 'movie_id');
}

public function genres() {
    return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id');
}

public function watchlists() {
    return $this->belongsToMany(Watchlist::class, 'movie_watchlist', 'movie_id', 'watchlist_id');
}
}
