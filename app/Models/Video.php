<?php

namespace App\Models;

use App\Filters\VideoFilters;
use App\Models\Traits\Likeable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory, Likeable;

    protected $fillable = [
        'name', 'length', 'path', 'thumbnail', 'slug', 'description', 'category_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLengthInHumanAttribute()
    {
        return gmdate('i:s', $this->length);
    }

    public function relatedVideos(int $count = 0)
    {
        return $this->category->getRandomVideos($count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwnerNameAttribute()
    {
        return $this->user?->name;
    }

    public function getOwnerAvatarAttribute()
    {
        return $this->user?->gravatar;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function getVideoUrlAttribute()
    {
        return '/storage/' . $this->path;
    }

    public function getVideoThumbnailAttribute()
    {
        return '/storage/' . $this->thumbnail;
    }

    public function scopeFilter(Builder $builder, array $params)
    {
        return (new VideoFilters($builder))->apply($params);
    }
}
