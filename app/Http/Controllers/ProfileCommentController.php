<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\Comment;
use Illuminate\Http\Request;

class ProfileCommentController extends Controller
{
    public function index($profile_id)
    {
        $comments = Comment::get()->where('profile_id', $profile_id);
        if (is_null($comments))
            return response()->json('Data not found', 404);
        return response()->json($comments);
    }
}
