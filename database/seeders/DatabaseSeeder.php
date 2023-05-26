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
      
      
      $user = User::factory()->create();

      $post1 = Post::factory()->create([
        'user_id'=>$user->id,
    ]);

    $post2 = Post::factory()->create([
      'user_id'=>$user->id,
  ]);
  $post3 = Post::factory()->create([
    'user_id'=>$user->id,
]);
    Comment::factory(10)->create([
      'user_id'=>$user->id,
      'post_id'=>$post1->id
  ]);
  Comment::factory(10)->create([
    'user_id'=>$user->id,
    'post_id'=>$post2->id
]);

$commentCount = Comment::where('post_id', $post1->id)->count();
$post1->comments_count = $commentCount;
$post1->save();

$commentCount2 = Comment::where('post_id', $post1->id)->count();
$post2->comments_count = $commentCount2;
$post2->save();
      //$comment = Comment::factory(10)->create();
    }
}
