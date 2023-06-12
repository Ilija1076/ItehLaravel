<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    public function index($article_id)
    {
        $comments = Comment::get()->where('article_id', $article_id);
        if (is_null($comments))
            return response()->json('Data not found', 404);
        return response()->json($comments);
    }
}
