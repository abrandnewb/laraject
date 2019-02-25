 @extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
    <div class="card-header">
        <h1>Create Post</h1>
    </div>
  <div class="card-body">
      <form method="post" enctype="multipart/form-data" action="{{action('postsController@store')}}">
        @csrf
          <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" class="form-control" name="title" value="{{ old('title') }}"/>
          </div>
          <div class="form-group">
              <label for="body">Body:</label>
              <textarea id="article-ckeditor" class="form-control" name="body">{{ old('body') }}</textarea>
          </div>
          <div class="form-group">
              <label for="cover_image">Image:</label>
              <input class="form-control" type="file" name="cover_image">
          </div>
          <button type="submit" class="btn btn-primary">save</button>
      </form>
  </div>
</div>
@endsection