@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Back</a>
<h1>{{$post->title}}</h1>
<small>Created at: {{ date('F d, Y', strtotime($post->created_at)) }}</small>
<p>{!!$post->body!!}</p>
<a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

<form method="post" action="{{action('postsController@destroy', $post->id)}}" class="pull-right">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endsection