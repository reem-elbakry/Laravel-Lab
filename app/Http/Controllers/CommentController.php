<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;


class CommentController extends Controller
{

    public function store()
    {
        $data = request()->all();
        Comment::create([
            'user_id' => $data['user_id'],
            'post_id' => $data['post_id'],
            'comment' => $data['comment'],
        ]);
        return redirect()->route('posts.show', ['post' => $data['post_id']]); 
    }
    public function destroy($id){
        
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back();
    }

    public function edit($id){
        $comment = Comment::findOrFail($id);
        return redirect()->back()->with('comment', $comment); 
    }

    public function update($id){
        $data = request()->all();
        Comment::where('id', $id)
        ->update(['comment' => $data['comment']]);
        return redirect()->back();
    }

}
