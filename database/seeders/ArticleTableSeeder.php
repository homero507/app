<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Article;
use App\Models\User;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Article::truncate();

        $faker = \Faker\Factory::create();

        $users = User::all();

        foreach ($users as $user){

            
            JWTAuth::attempt(['email' => $user->email, 'password' => '159635']);

            $num_articles = 5;

            for ($i=0; $i < $num_articles; $i++) { 

                Article::create([
                    'title' => $faker->sentence(),
                    'body' => $faker->paragraph(5),
                    'user_id' => $user->id,
                    'category_id' => $faker->numberBetween($min = 1, $max = 3)
                ]);
            }
        }        
        
    } 
}
