<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    
    public function index(){

        $posts = Post::all();   //colletion 
        return view('posts.index', ["posts"=>$posts]);

    }
    public function show($id){

        $post = Post::findOrFail($id);
        return view('posts.show', ["post"=>$post]);
    }
    public function create(){
        $users = User::all();
        return view('posts.create', ["users"=>$users]);
        }
    
        public function store(){

            $data = request()->all();
            Post::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],  //value of option is user id ..
        ]);

        return redirect()->route('posts.index');

    }
    public function edit($id){
        $post = Post::findOrFail($id);
        $users = User::all();
        return view('posts.edit', ['post'=>$post, "users"=>$users] );
       
    }

    public function update($id){

        $data = request()->all();
        Post::where('id', $id)
        ->update(['title' => $data['title'], 'description' => $data['description'], 'user_id' => $data['post_creator']]);

        return redirect()->route('posts.index');
    }
    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');

    }


        
}
