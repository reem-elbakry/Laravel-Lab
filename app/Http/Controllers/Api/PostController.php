<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){

        return Post::all();
    }

    public function show($postId){
        
        return  Post::findOrFail($postId);
    }


    public function store(FormPostRequest $request){

        //request() return obj which has methods on it >> all() ..
        $data = request()->all();
        $image_name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('public/images/posts', $image_name);
    
        $post = Post::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],  //value of option is user id ..
                'image' => $image_name,
        ]);
        // PruneOldPostsJob::dispatch($post)->delay(now()->addMinutes(10));

        return redirect()->route('posts.index');

    }



    public function update($id, FormPostRequest $request){

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
