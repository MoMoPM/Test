<?php

use Illuminate\Database\Seeder;

class MoviesAuthorsSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies_author')->insert(array(
            array(
            'movie_id' => "1",
            'author_id ' => '1',
            ),
            array(
                'movie_id' => "1",
                'author_id ' => '2',
            )
            ));
             
    }
}