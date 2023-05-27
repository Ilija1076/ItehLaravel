<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function index($post_id)
    {
        $comments = Comment::get()->where('post_id', $post_id);
        if (is_null($comments))
            return response()->json('Data not found', 404);
        return response()->json($comments);
    }
}
