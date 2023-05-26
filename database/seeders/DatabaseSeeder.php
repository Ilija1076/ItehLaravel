<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      User::truncate();
      Comment::truncate();  
      Post::truncate();
      
      
      $user = User::factory(10)->create();

      $post = Post::factory(5)->create();

      //$comment = Comment::factory(10)->create();
    }
}
