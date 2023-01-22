<?php

namespace App\Models;

use App\Models\Genres;
use App\Models\Authors;
use App\Models\Tags;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'image',
        'rating',
        'link'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genres::class, 'movies_genres', 'movies_id','genres_id')->withTimestamps();;
    }

    public function authors()
    {
        return $this->belongsToMany(Authors::class, 'movies_authors', 'movies_id','authors_id')->withTimestamps();;
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'movies_tags', 'movies_id','tags_id')->withTimestamps();;
    }

    public function comments()
    {
        return $this->hasMany(Comments::class)->withTimestamps();;
    }
}
