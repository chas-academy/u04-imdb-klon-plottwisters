<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Auth\Access\Response;

class WatchlistPolicy
{
   public function view(User $user, Watchlist $watchlist)
    {
        return $user->id === $watchlist->user_id;
    }

    public function update(User $user, Watchlist $watchlist)
    {
        return $user->id === $watchlist->user_id;
    }
}
