<?php

namespace Database\Seeders;
use App\Models\Profile;
use App\Models\Article;
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

      Profile::truncate();
      Comment::truncate();  
      Article::truncate();
      
      
      $profile = Profile::factory()->create();
      $profile2 = Profile::factory()->create();
      $profile3 = Profile::factory()->create();
      $profile4 = Profile::factory()->create();
      $article1 = article::factory()->create([
        'profile_id'=>$profile->id,
    ]);

    $article2 = Article::factory()->create([
      'profile_id'=>$profile2->id,
  ]);
  $article3 = Article::factory()->create([
    'profile_id'=>$profile3->id,
]);
    Comment::factory(5)->create([
      'profile_id'=>$profile->id,
      'article_id'=>$article1->id
  ]);
  Comment::factory(5)->create([
    'profile_id'=>$profile2->id,
    'article_id'=>$article1->id
]);
  Comment::factory(5)->create([
    'profile_id'=>$profile3->id,
    'article_id'=>$article2->id
]);
Comment::factory(5)->create([
  'profile_id'=>$profile4->id,
  'article_id'=>$article3->id
]);
$commentCount = Comment::where('article_id', $article1->id)->count();
$article1->comments_count = $commentCount;
$article1->save();

$commentCount2 = Comment::where('article_id', $article2->id)->count();
$article2->comments_count = $commentCount2;
$article2->save();

$commentCount3 = Comment::where('article_id', $article3->id)->count();
$article3->comments_count = $commentCount2;
$article3->save();
    
$profileCommentCount = Comment::where('profile_id', $profile->id)->count();
$profile->profiles_comments = $profileCommentCount;
$profile->save();

$profile2CommentCount = Comment::where('profile_id', $profile2->id)->count();
$profile2->profiles_comments = $profile2CommentCount;
$profile2->save();

$profile3CommentCount = Comment::where('profile_id', $profile3->id)->count();
$profile3->profiles_comments = $profile3CommentCount;
$profile3->save();

$profile4CommentCount = Comment::where('profile_id', $profile4->id)->count();
$profile4->profiles_comments = $profile4CommentCount;
$profile4->save();
}
}