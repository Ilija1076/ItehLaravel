<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\Article;
use App\Models\Comment;

use Illuminate\Http\Request;

class ProfileArticleCommentController extends Controller
{
    public function index($profile_id, $article_id)
    {
        $profile = Profile::find($profile_id);

        if (is_null($profile))
            return response()->json('profile not found', 404);

        $article = Article::where('profile_id', $profile_id)->find($article_id);

        if (is_null($article))
            return response()->json('Article not found', 404);

        $comments = $article->comments;

        if ($comments->isEmpty())
            return response()->json('Comments not found', 404);

        return response()->json($comments);
    }
}

