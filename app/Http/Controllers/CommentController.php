<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Article;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;
use Illuminate\Http\Request;

class CommentController extends Controller
{  
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $comments = Comment::all();

        return new CommentCollection($comments);
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:255',
            'article_id' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());
            
        $comment =  Comment::create([
            'text' => $request->text,
            'profile_id' => Auth::profile()->id,
            'article_id' => $request->article_id,
        ]);

        $article = Article::find($request->article_id);
        $article->comments_count += 1;
        $article->save();
        $comment->profile->increment('profiles_comments');
        

        return response()->json(['Comment is created successfully.', new CommentResource($comment)]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:255'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $comment->text = $request->text;
        $comment->save();

        return response()->json(['Comment is updated successfully.', new CommentResource($comment)]);

    }
          /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json('Comment is deleted successfully.');
    }
}
