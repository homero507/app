<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Administrador',
            'email' => 'Adminprueba@example.com',
            'password' => 159635,
        ]);

        $password = Hash::make('yourPa$$w0rd');

        for ($i=0; $i < 10 ; $i++) { 
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => Carbon::now(),
                'password' => $password,

            ]);
        }
    } 
}
