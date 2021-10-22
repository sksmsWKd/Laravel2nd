<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function index_test()
    {
        /*
            select * 
            from comments
            where post_id = $post->id;
        */
        // return $post->comments;
        // post eloquent->class 에 comment 메서드를 구현해야함.
    }
    public function index()
    {



        return  Comment::all();
        /*
            order by created_at desc;

        */
    }


    public function store(Request $request, $post)
    {
        $comments = new Comment();
        $request->validate(['comment']);

        $comments->comment = $request->comment;
        $comments->user_id = Auth::user()->id;
        $comments->post_id = $post;

        $comments->save();

        return $comments;
    }

    public function update(Request $request, $id)

    {
        $comments = Comment::find($id);
        $comments->comment = $request->commentInfo;
        $comments->save();

        return $comments;
    }
    public function destroy($id)
    {
        Comment::find($id)->delete();

        $comments = Comment::all();
        return $comments;
    }
}
