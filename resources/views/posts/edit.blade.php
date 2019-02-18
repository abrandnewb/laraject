@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
    <div class="card-header">
        <h1>Edit Post</h1>
    </div>
  <div class="card-body">
      <form method="post" action="{{action('postsController@update', $post->id)}}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" class="form-control" name="title" value="{{ $post->title }}"/>
          </div>
          <div class="form-group">
              <label for="body">Body:</label>
              <textarea id="article-ckeditor" class="form-control" name="body">{{ $post->body }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary">save</button>
      </form>
  </div>
</div>
@endsection