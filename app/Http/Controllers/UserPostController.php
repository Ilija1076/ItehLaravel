<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index($user_id)
    {
        $posts = Post::get()->where('user_id', $user_id);
        if (is_null($posts))
            return response()->json('Data not found', 404);
        return response()->json($posts);
    }
}
