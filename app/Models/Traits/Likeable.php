<?php

namespace App\Models\Traits;


use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait Likeable
{

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getLikesCountAttribute()
    {
        $cacheKeyName = 'likes_count_for_' . class_basename($this) . '_' . $this->id;

        return Cache::remember($cacheKeyName, 3600, function () {
            return $this->likes()
                ->where('vote', 1)
                ->count();
        });
    }

    public function getDisLikesCountAttribute()
    {
        $cacheKeyName = 'dislikes_count_for_' . class_basename($this) . '_' . $this->id;

        return Cache::remember($cacheKeyName, 3600, function () {
            return $this->likes()
                ->where('vote', -1)
                ->count();
        });

    }

    public function likedBy(User $user)
    {
        if ($this->isLikedBy($user)) return;

        return $this->likes()->create([
            'vote' => 1,
            'user_id' => $user->id
        ]);
    }

    public function dislikedBy(User $user)
    {
        if ($this->isDisLikedBy($user)) return;

        return $this->likes()->create([
            'vote' => -1,
            'user_id' => $user->id
        ]);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()
            ->where('vote', 1)
            ->where('user_id', $user->id)
            ->exists();
    }

    public function isDisLikedBy(User $user)
    {
        return $this->likes()
            ->where('vote', -1)
            ->where('user_id', $user->id)
            ->exists();
    }
}
