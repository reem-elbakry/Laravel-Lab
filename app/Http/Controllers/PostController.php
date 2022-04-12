<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    
    private $posts = [
        ['id'=>1, 'title'=>'first-post', 'desc'=>'my first post!', 'posted_by'=>'reem', 'created_at'=> '2022-12-12'],
        ['id'=>2, 'title'=>'second-post', 'desc'=>'my second post!', 'posted_by'=>'rania', 'created_at'=> '2020-11-11'],
        ['id'=>3, 'title'=>'third-post', 'desc'=>'my third post!', 'posted_by'=>'mahmoud', 'created_at'=> '2020-10-10']
    ];
    private $id = 3;
    public function index(){

        return view('posts.index', ["posts"=>$this->posts]);
    }

    public function create(){
       return view('posts.create');
    }

    public function store(Request $request){
        $title = $request->title;
        $desc = $request->desc;
        $creator = $request->creator;
        $id = $this->id;
        $id = $id + 1;
        $posts = $this->posts;
        $post = ['id'=> $id, 'title'=>$title, 'desc'=> $desc, 'posted_by'=>$creator, 'created_at'=>'2022-3-20'];
        array_push($posts,$post);
        return view('posts.index', ["posts"=>$posts]);
    }

    public function show($id){
        $posts = $this->posts;
        foreach ($posts as $key => $post) {
            if($key+1 == $id){
                return view('posts.show', ["post"=>$post]);
            }
        }
    }

    public function destroy($id){
        $posts =$this->posts;
        foreach ($posts as $key => $post) {
        if($key+1 == $id){
                unset($posts[$key+1]);
                dd($posts);
                return redirect()->route('posts.index');
            }
        }

    }

    public function edit($id){
       
    }
}
