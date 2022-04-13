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
  <label for="comment" class="form-label"></label>
  <input type="text" class="form-control" id="comment" name="comment">
  <br>
    <p class="card-text">{{$post->description}}</p>
  </div>
</div>
<!-- <div class="card m-5">
  <div class="card-header">
   <h2> Post info </h2>
  </div>
  <div class="card-body">
    <h5 class="card-title">Title: {{$post->title}} </h5>
    <p class="card-text">Description: {{$post->description}}</p>
  </div>
</div> -->
<!-- <div class="card m-5">
  <div class="card-header">
   <h2> Post creator info </h2>
  </div>
  <div class="card-body">
    <h5 class="card-title">Name: {{$post->user->name}}</h5>
    <p class="card-text">Created at: {{$post['created_at']}}</p>
  </div>
</div> -->
</div>
</div>

@endsection