 @extends('layouts.app')
{{--
@section('content')
@endsection --}}


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
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{action('postsController@store')}}">
          <div class="form-group">
              @csrf
              <label for="title">Title:</label>
              <input type="text" class="form-control" name="title" value="{{ old('title') }}"/>
          </div>
          <div class="form-group">
              <label for="body">Body:</label>
              <input type="textarea" class="form-control" name="body" value="{{ old('body') }}"/>
          </div>
          <button type="submit" class="btn btn-primary">save</button>
      </form>
  </div>
</div>
@endsection