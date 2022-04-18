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


    public function store(){

        if(request()->header('Accept') && request()->header('Accept') == 'application/pdf'){
            return 'pdf response';
        }
     return 'we are in store';

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
