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

    public function getLengthAttribute($value)
    {
        return gmdate('i:s', $value);
    }

    public function relatedVideos(int $count = 0)
    {
        return Video::all()->random($count);
    }
}
