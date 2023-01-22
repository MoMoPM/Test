<?php
namespace Database\Seeders;

use App\Models\Movies;
use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movies::create(['title' => 'Harry Potter1', 'summary' => 'movie summary', 'image' => '1674386067.jpg',  'rating' => '4',  'link' => 'www.youtube.com']);
        Movies::create(['title' => 'Harry Potter2', 'summary' => 'movie summary', 'image' => '1674386067.jpg',  'rating' => '4',  'link' => 'www.youtube.com']);
        Movies::create(['title' => 'Ginny & Georia', 'summary' => 'movie summary', 'image' => '1674386067.jpg',  'rating' => '4',  'link' => 'www.youtube.com']);
        Movies::create(['title' => 'Replay 1988', 'summary' => 'movie summary', 'image' => '1674386067.jpg',  'rating' => '4',  'link' => 'www.youtube.com']);
        Movies::create(['title' => 'If I stay', 'summary' => 'movie summary', 'image' => '1674386067.jpg',  'rating' => '4',  'link' => 'www.youtube.com']);
    }
}