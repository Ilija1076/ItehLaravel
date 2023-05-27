<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Http\Request;

class UserPostCommentController extends Controller
{
    public function index($user_id, $post_id)
    {
        $user = User::find($user_id);

        if (is_null($user))
            return response()->json('User not found', 404);

        $post = Post::where('user_id', $user_id)->find($post_id);

        if (is_null($post))
            return response()->json('Post not found', 404);

        $comments = $post->comments;

        if ($comments->isEmpty())
            return response()->json('Comments not found', 404);

        return response()->json($comments);
    }
}

