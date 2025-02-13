<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_genre extends Model
{
    use HasFactory;
    
 
    protected $fillable = ['genre_id', 'movie_id'];
   


    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_id');
    }
}
