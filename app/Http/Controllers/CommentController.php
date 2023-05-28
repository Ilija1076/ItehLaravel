<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Models\Post;
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
            'post_id' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());
            
        $comment =  Comment::create([
            'text' => $request->text,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ]);

        $post = Post::find($request->post_id);
        $post->comments_count += 1;
        $post->save();
        $comment->user->increment('users_comments');
        

        return response()->json(['Comment is created successfully.', new CommentResource($comment)]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json('Comment is deleted successfully.');
    }
}
