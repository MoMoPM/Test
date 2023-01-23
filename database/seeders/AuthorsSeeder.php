<?php
namespace Database\Seeders;

use App\Models\Authors;
use Illuminate\Database\Seeder;
use DB;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Authors::create(['name' => 'j. k. rowling']);
        Authors::create(['name' => 'Federico Fellini']);
        Authors::create(['name' => 'Jean Renoir']);
        Authors::create(['name' => 'D.W. Griffith']);
        Authors::create(['name' => 'John Huston']);
        Authors::create(['name' => 'Orson Welles']);
        Authors::create(['name' => 'Francis Ford Coppola']);

        DB::table('movies_authors')->truncate();

        State::create(['movies_id' => '1', 'authors_id' => '1']);
    }
}