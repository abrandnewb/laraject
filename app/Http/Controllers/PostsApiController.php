<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use App\Post;

class PostsApiController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        
        return PostResource::collection($posts);
    }

    public function show($id) {
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    /* public function store(Request $request) {
        $post = $request->isMethod('put') ? Post::findOrFail($request->post_id) : new Post;

        $post->id = $request->input('post_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if($post->save()) {
            return new PostResource($post);
        }
    } */
    public function store(Request $request) {
        $post = new Post;

        $post->id = $request->input('post_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = 1;
        $post->cover_image = '';

        if($post->save()) {
            return new PostResource($post);
        }
    }
    public function update(Request $request) {
        $post = Post::findOrFail($request->post_id);

        $post->id = $request->input('post_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if($post->save()) {
            return new PostResource($post);
        }
    }
    
    public function destroy($id) {
        $post = Post::findOrFail($id);

        if($post->delete()) {
            return new PostResource($post);
        }
    }
}
