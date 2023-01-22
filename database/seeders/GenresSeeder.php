<?php
namespace Database\Seeders;

use App\Models\Genres;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genres::create(['title' => 'Comedy']);
        Genres::create(['title' => 'Action']);
        Genres::create(['title' => 'Drama']);
        Genres::create(['title' => 'Fantacy']);
        Genres::create(['title' => 'Kids Movie']);
    }
}