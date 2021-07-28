<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Database\Seeders\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //User::truncate();

        $faker = \Faker\Factory::create();

        User::create([
            'name' => 'homero',
            'email' => 'homero@example.com',
            'password' => 159635,
        ]);

        $password = Hash::make('yourPa$$w0rd');

        for ($i=0; $i < 10 ; $i++) { 
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->safeEmail,

                'password' => $password,

            ]);

            $user->categories()->saveMany(
                 $faker->randomElements(
                 array(
                 Category::find(1),
                 Category::find(2),
                 Category::find(3)
                 ), $faker->numberBetween($min = 1, $max = 3), false)
            );
        }
    } 
}
