@extends('layouts.app')
@section('title')
    post
@endsection
@section('content')



<div class="card m-5">
  <div class="card-header">
    Post info: 
  </div>
  <div class="card-body">
    <h5 class="card-title">Title: {{$post["title"]}} </h5>
    <p class="card-text">Description: {{$post["desc"]}}</p>
  </div>
</div>
<div class="card m-5">
  <div class="card-header">
    Post creator info:
  </div>
  <div class="card-body">
    <h5 class="card-title">Name: {{$post['posted_by']}}</h5>
    <p class="card-text">Created at: {{$post['created_at']}}</p>
  </div>
</div>

@endsection