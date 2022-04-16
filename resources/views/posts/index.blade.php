@extends('layouts.app')
@section('title') 
  posts
@endsection
@section('content')

<div class="text-center m-5">
<a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>

</div>
<div class="row justify-content-center">  
  <div class="col-6">
    <table class="table table-responsive">
      <thead>
        <tr class="text-center">
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Posted By</th>
          <th scope="col">Created At</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($posts as $post)
      <tr class="text-center">
          <th scope="row">{{$post->id}}</th>
          <td>{{$post->title}}</td>
          <td>{{$post->user ? $post->user->name : 'Not found'}}</td>
          <td>{{$post->created_at->format('Y-m-d')}}</td>
          <td>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
          <a href="{{route('posts.show', ['post' => $post['id']])}}" class="btn btn-primary m-1">View</a>
          <form method="POST" action="{{route('posts.edit', ['post' => $post['id']])}}" class="form-inline">
            @csrf
            @method('get')
            <button type="submit" class="btn btn-warning m-1">Edit</button>
          </form >
          <form method="POST" action="{{route('posts.destroy', ['post' => $post['id']])}}" class="form-inline" onSubmit=" return confirm('Delete the post akeed!')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger m-1">Delete</button>
          </form>
        </div>
          </td>
        </tr>
        @endforeach 
      </tbody>
    </table>
  </div>
  <div>
</div>
{{$posts->links()}}

</div>


@endsection

