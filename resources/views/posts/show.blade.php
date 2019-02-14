@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Back</a>
<h1>{{$post->title}}</h1>
<small>Created at: {{$post->created_at}}</small>
<p>{{$post->body}}</p>
@endsection