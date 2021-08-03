<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Admin;
use App\Models\Writer;
use Database\Seeders\Categories;
use Illuminate\Support\Facades\DB;
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

        $password = Hash::make('159635');

        $admin = Admin::create(['credential_number' => '1234567890',]);

        $admin->user()->create([
            'name' => 'homero',
            'email' => 'homero@example.com',
            'password' => $password,
            'role' => 'ROLE_ADMIN',
        ]);

        for ($i=0; $i < 10 ; $i++) { 

          $writer = Writer::create([
            'editorial' => $faker->company,
            'short_bio' => $faker->paragraph,
          ]);



          $user = $writer->user()->create([

                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => $password,

            ]);   

           // $user = User::find('id');

            $user->categories()->saveMany(

                $faker->randomElements(
                array(

                 Category::find(1),
                 Category::find(2),
                 Category::find(3) 

                    ), $faker->numberBetween($min = 1, $max = 3), false

                )

            );
        }
    } 
}
