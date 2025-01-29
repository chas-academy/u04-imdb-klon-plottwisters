<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $fillable = ['watchlist_name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
