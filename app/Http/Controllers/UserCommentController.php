<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function index($user_id)
    {
        $comments = Comment::get()->where('user_id', $user_id);
        if (is_null($comments))
            return response()->json('Data not found', 404);
        return response()->json($comments);
    }
}
