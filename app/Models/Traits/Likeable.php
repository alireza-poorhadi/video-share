<?php

namespace App\Models\Traits;

use App\Models\Like;
use App\Models\User;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()
        ->where('vote', 1)
        ->count();
    }

    public function getDislikesCountAttribute()
    {
        return $this->likes()
        ->where('vote', -1)
        ->count();
    }

    public function likedBy(User $user)
    {
        if ($this->isLikedBy($user)) {
            return $this->likes()->where('user_id', $user->id)->delete();
        }

        return $this->likes()->create([
            'user_id' => $user->id,
            'vote' => 1
        ]);
    }

    public function dislikedBy(User $user)
    {
        if ($this->isDislikedBy($user)) {
            return $this->likes()->where('user_id', $user->id)->delete();
        }

        return $this->likes()->create([
            'user_id' => $user->id,
            'vote' => -1
        ]);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()
        ->where('vote', 1)
        ->where('user_id', $user->id)
        ->exists();
    }

    public function isDislikedBy(User $user)
    {
        return $this->likes()
        ->where('vote', -1)
        ->where('user_id', $user->id)
        ->exists();
    }
}
