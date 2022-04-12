@extends('layouts.app')
@section('title') 
  create post
@endsection
@section('content')
<form class="m-5" method="POST" action="{{route('posts.store')}}">
@csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
  </div>
  <div class="mb-3">
    <label for="creator" class="form-label">Post Creator</label>
    <select class="form-select" aria-label="Default select example" id="creator" name="creator">
        <option value="none"></option>
        <option value="reem">Reem</option>
        <option value="rania">Rania</option>
        <option value="mahmoud">Mahmoud</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Post</button>
</form>
@endsection
