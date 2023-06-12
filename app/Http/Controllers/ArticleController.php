<?php

namespace App\Http\Controllers;

use App\Http\Resources\articleCollection;
use App\Models\Article;
use App\Models\Comment;
use App\Http\Resources\articleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return new ArticleCollection($articles);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

 
   /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       //;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:100',
            'content' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $article = Article::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'profile_id' => Auth::profile()->id,
            'comments_count' =>0
        ]);

        return response()->json(['article is created successfully.', new ArticleResource($article)]);
    }
    public function update(Request $request, article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:100',
            'content' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $article->title = $request->title;
        $article->slug = $request->slug;
        $article->content = $request->content;

        $article->save();

        return response()->json(['article is updated successfully.', new ArticleResource($article)]);

    }
          /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        $article->delete();

        return response()->json('Article is deleted successfully.');
    }
}
   

