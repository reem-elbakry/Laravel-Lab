<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\FormPostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();

        return PostResource::collection($posts);
    }

    public function show($postId){

        $post = Post::findOrFail($postId);

        return new PostResource($post);
    }


    public function store(FormPostRequest $request){

        // if(request()->header('Accept') && request()->header('Accept') == 'application/pdf'){
        //     return 'pdf response';
        // }

        $data = request()->all();

        $post = Post::create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'user_id' => $data['post_creator'],  //value of option is user id ..
              ]);

        return new PostResource($post);            
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
