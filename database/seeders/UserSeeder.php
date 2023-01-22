<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Jhon', 'password' => Hash::make('12345678'), 'email' => 'jhon@mail.com']);
        User::create(['name' => 'Mia', 'password' => Hash::make('12345678'), 'email' => 'mia@mail.com']);
        User::create(['name' => 'Emily', 'password' => Hash::make('12345678'), 'email' => 'emily@mail.com']);
        User::create(['name' => 'Ethan', 'password' => Hash::make('12345678'), 'email' => 'ethan@mail.com']);
    }
}