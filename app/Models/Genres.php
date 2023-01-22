<?php

namespace App\Models;

use App\Models\Movies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'movies_genres', 'movies_id', 'genres_id');
    }
}
