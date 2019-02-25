@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach( $posts as $post)
            <div class="well" style="border: 1px solid #eee;margin:1px;">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        @if($post->cover_image !== '')
                            <img style="width:70%" src="/storage/cover_images/{{$post->cover_image}}">
                        @else 
                            <img style="width:70%" src="/storage/cover_images/placeholder-img.jpg">
                        @endif
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Created at: {{ date('F d, Y', strtotime($post->created_at)) }} by {{$post->user->name}}</small>
                    </div>
                </div>
            </div>        
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found.</p>
    @endif
@endsection