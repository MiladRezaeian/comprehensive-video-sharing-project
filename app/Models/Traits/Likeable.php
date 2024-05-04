<?php

namespace App\Models\Traits;


use App\Models\Like;

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

    public function getDisLikesCountAttribute()
    {
        return $this->likes()
            ->where('vote', -1)
            ->count();
    }

    public function likeBy(User $user)
    {
        return $this->likes()->create([
            'vote' => 1,
            'user_id' => $user->id
        ]);
    }

    public function dislikeBy(User $user)
    {
        return $this->likes()->create([
            'vote' => -1,
            'user_id' => $user->id
        ]);
    }
}
