<?php
namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tags::create(['name' => ' #comedymovie']);
        Tags::create(['name' => '#netflixmovies']);
        Tags::create(['name' => '#kpop']);
        Tags::create(['name' => '#replay']);
        Tags::create(['name' => '#moviestarplanet']);
        Tags::create(['name' => '#scarymovies']);
        Tags::create(['name' => '#actionmovies']);
    }
}