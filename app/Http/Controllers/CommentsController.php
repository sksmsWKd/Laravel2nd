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
    public function index($postId)
    {

        $comments = Comment::with('user')->where('post_id', $postId)->latest()->paginate(5);


        //지연로딩 필요한 이유
        //클라이언트에서는 $comments 가 갈때, with 안해주면 user와 연관된 정보가 안감

        return $comments;
        /*
            order by created_at desc;

        */
    }


    public function store(Request $request, $post)
    {
        $comments = new Comment();
        $request->validate(['comment' => 'required']);


        /*
 $this->valudate($request,['comment'=>'required'])
        */

        $comments->comment = $request->comment;
        $comments->user_id = Auth::user()->id;
        $comments->post_id = $post;

        $comments->save();



        return $comments;


        /*
            $comments =  Comment::create(['comment'=>request->input('comment'),
            'user_id'=> //로그인유저id
            ..
            ])
            return $comments;


            create 에 사용할수있는 칼럼은
            엘로컨트 모델 클래스에 protected $fillable 에 명시되야함.

        */
    }

    public function update(Request $request, $id)

    {
        $comments = Comment::find($id);
        $this->authorize('update', $comments);

        $comments->comment = $request->commentInfo;
        $comments->save();



        return $comments;


        /*
                $comment->update(['comment'=>$request->input('comment')])
                할때도 , 칼럼들은 fillable에 있어야함

        */
    }
    public function destroy($id)
    {

        $comments = Comment::find($id);
        $this->authorize('delete', $comments);
        $comments->delete();


        return 1;
    }
}



//loginuser props로 댓글 권한 관리 -> policy만들기
// vuefile 에서도 수정 삭제 버튼 권한.