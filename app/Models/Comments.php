<?php

namespace App\Models;

use App\Models\Movies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'comment'
    ];

    public function movies()
    {
        return $this->belongsTo(Movies::class);
    }
}
