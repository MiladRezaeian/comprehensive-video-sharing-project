<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'length', 'url', 'thumbnail', 'slug', 'description'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLengthInHumanAttribute()
    {
        return gmdate('i:s', $this->value);
    }

    public function relatedVideos(int $count = 0)
    {
        return Video::all()->random($count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
