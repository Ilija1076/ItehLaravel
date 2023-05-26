<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return new PostCollection($posts);
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       return new PostResource($post);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:100',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $post = Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json(['Post is created successfully.', new PostResource($post)]);
    }
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:100',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        $post->save();

        return response()->json(['Post is updated successfully.', new PostResource($post)]);

    }
          /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json('Post is deleted successfully.');
    }
}
   

