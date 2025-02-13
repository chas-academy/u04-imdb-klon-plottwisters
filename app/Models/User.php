<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Model;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    
    protected $fillable = ['name', 'email', 'password', 'is_admin', 'profile_picture'];

    public function reviews() {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function watchlists() {
        return $this->hasMany(Watchlist::class, 'user_id');
    }

    // Create wathclist so new users always have one
   protected static function booted()
    {
    static::created(function ($user) {
        Watchlist::create([
            'watchlist_name' => 'My List',
            'user_id' => $user->id,
        ]);
    });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
