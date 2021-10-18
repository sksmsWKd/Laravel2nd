<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function index_test(){
        /*
            select * 
            from comments
            where post_id = $post->id;
        */
        return $post->comments;
        // post eloquent->class 에 comment 메서드를 구현해야함.
    }
    public function index($postId){

        /*
            order by created_at desc;

        */
        $comments = Comment::where('post_id','=',$postId);

        return $comments;

    }


    public function store(Request $request)
    {
        $request->validate(['comment']);
        // $request->input('commentBody');

    }
}
    public function update()
    {

    }
    public function destroy(){

    }
  
