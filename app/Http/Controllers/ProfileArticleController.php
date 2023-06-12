<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class ProfileArticleController extends Controller
{
    public function index($profile_id)
    {
        $articles = Article::get()->where('profile_id', $profile_id);
        if (is_null($articles))
            return response()->json('Data not found', 404);
        return response()->json($articles);
    }
}
