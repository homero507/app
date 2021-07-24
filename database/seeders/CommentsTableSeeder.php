<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use App\Models\User;
use DB;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Request $request)
    {
        //Comment::truncate();

            $faker = \Faker\Factory::create();

            $articles = Article::all();

            $users = User::all();

                foreach ($users as $user) {
                    
                    JWTAuth::attempt(['email' => $user->email, 'password' => '159635']);

                    foreach ($articles as $article) {
                        Comment::create([
                            'text' => $faker->paragraph,
                            'user_id' => $user->id,
                            'article_id' => $article->id,
                        ]);
                    }
                }

        
    }
    
}