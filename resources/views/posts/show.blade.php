@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Back</a>
<h1>{{$post->title}}</h1>
@if($post->cover_image !== '')
<img style="width:100%;height:300px;" src="/storage/cover_images/{{$post->cover_image}}">
@else 
<img style="width:100%;height:300px;" src="/storage/cover_images/placeholder-img.jpg">
@endif
<small>Created at: {{ date('F d, Y', strtotime($post->created_at)) }} by {{$post->user->name}}</small>
<p>{!!$post->body!!}</p>

{{-- hide edit & delete buttons if not own post --}}
@if(!Auth::guest())
  @if(Auth::id() == $post->user_id)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

    {{-- delete modal --}}
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
        Delete
    </button>
          
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{action('postsController@destroy', $post->id)}}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                  <p>Are you sure you want to delete this?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    {{-- end delete modal --}}
  @endif
@endif
@endsection