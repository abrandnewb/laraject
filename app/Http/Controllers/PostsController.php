<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Event;
//use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = DB::table("posts")->get();
        //$posts = Post::orderBy('title','desc')->get();
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //return Post::where('title','Post two')->get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        
        return view('posts.index')->with('posts', $posts);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'//validation does not work e.g. for 10MB image
        ]);

        //handling file upload
        if($request->hasFile('cover_image')) {
            //get file name with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get file name only
            $filemame = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get only the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //add time to prevent name conflict when uploading
            $fileNameToStore = $filemame.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else {
            $fileNameToStore = '';
        }
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        //register event
        $event = new Event();
        $event->name = 'create';
        $event->event_item = $post->id;
        $event->user = auth()->user()->id;
        $event->save();

        return redirect('/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        //check if post is oun
        if(!$post) {
            return redirect('/posts');
        }

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //check if post is oun
        if(auth()->id() !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //handling file upload
        if($request->hasFile('cover_image')) {
            //get file name with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get file name only
            $filemame = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get only the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //add time to prevent name conflict when uploading
            $fileNameToStore = $filemame.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        //register event
        $event = new Event();
        $event->name = 'update';
        $event->event_item = $post->id;
        $event->user = auth()->user()->id;
        $event->save();

        return redirect('/posts')->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //check if post is oun
        if(auth()->id() !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        if($post->cover_image) {
            Storage::delete('/public/cover_images/'.$post->cover_image);
        }
        $post->delete();

        //register event
        $event = new Event();
        $event->name = 'delete';
        $event->event_item = $post->id;
        $event->user = auth()->user()->id;
        $event->save();

        return redirect('/posts')->with('success', 'Post deleted');
    }
}
