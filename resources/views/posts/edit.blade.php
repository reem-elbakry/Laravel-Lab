@extends('layouts.app')
@section('title') 
  Edit post
@endsection
@section('content')
<form class="m-5" method="POST" action="{{route('posts.show', ['post' => $post['id']])}}" enctype="multipart/form-data">
@csrf
@method('patch')
  <div class="mb-3">
    <label for="title" class="form-label" >Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" rows="3" name="description">{{$post->description}}</textarea>
  </div>
  <div class="mb-3">
    <label for="post_creator" class="form-label">Post Creator</label>
    <select class="form-select" aria-label="Default select example" id="post_creator" name="post_creator" value="{{$post->user->name}}">
        <option value="none"></option>
        @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Edit</button>
</form>
@endsection
