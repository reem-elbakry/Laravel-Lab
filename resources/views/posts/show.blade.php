@extends('layouts.app')
@section('title')
    post
@endsection
@section('content')

<div class="row justify-content-center">  
  <div class="col-6">
  <div class="card m-5">
    <div class="card-header">
    <h4> {{$post->user->name}} </h4>
    </div>
    <div class="card-body">
      <h5 class="card-title">{{$post->title}}</h5>
      <p class="card-text">{{$post->description}}</p>
    </div>
  </div>
      <div class="card m-5">
        <div class="card-header">
        <h4>Comments</h4>
        </div>
        <div class="card-body">
          @if(session('comment'))
        <form method="post" action="{{route('comments.update', session('comment')->id )}}">
          @csrf
          @method('patch')
          @else
        <form method="post" action="{{route('comments.store',  ['post_id' => $post->id, 'user_id' => $post->user->id])}}">
          @csrf
          @method('post')
          @endif
        <label for="comment" class="form-label"></label>
        <textarea type="text" class="form-control" id="comment" name="comment">@if(session('comment')){{session('comment')->comment}}@endif</textarea>
        <button type="submit" class="btn btn-dark mt-3 mb-3">@if(session('comment'))Edit @else Comment @endif</button>
        </form>
        <br>
        <hr></hr>

@foreach($comments as $comment)
          @if($comment->post_id === $post->id)
          <h6>{{$comment->user->name}}</h6>
          <p class="card-text">{{$comment->comment}}</p>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
          <form method="POST" action="{{route('comments.edit', $comment->id)}}" class="form-inline">
            @csrf
            @method('get')
            <button type="submit" class="btn btn-link link-secondary d-inline">Edit</button>
          </form>
          <form method="POST" action="{{route('comments.destroy', ['comment' => $comment->id])}}" class="form-inline" onSubmit="return confirm('Delete the comment akeed!')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link link-secondary d-inline">Delete</button>
          </form>
        </div>
        <hr></hr>
          @endif
        @endforeach
      </div>
</div>
</div>
</div>

@endsection