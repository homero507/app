<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Schema::enableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        $this->call([
            
            UsersTableSeeder::class,
            ArticleTableSeeder::class,
            CommentsTableSeeder::class
            
        ]);
        Schema::disableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
 