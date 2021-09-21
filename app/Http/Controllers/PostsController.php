<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        1. 게시글 리스트를 DB에서 읽어오기
        2. 게시글 목록 만들어주는 blade에  읽어온 데이터를 전달
           실행.
        */

        // select * from order by created_at desc

        //1. $posts = Post::orderBy('created_at', 'desc')->get();
        //or 2.$posts = latest(); 도 가능.

        //라라벨의 collection 을 얻을떄 -> get()

        $posts = Post::latest()->paginate(10);

        // dd($posts);
        return view('bbs.index', ['posts' => $posts]);

        // 집합 - > 원소 순서 없음,  중복 허용 x
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bbs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate(['title' => 'required|min:3', 'content' => 'required|min:10']);


        $fileName = null;
        if ($request->hasFile('image')) {

            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();



            // dd($request->file('image'));
            $path = $request->file('image')->storeAs('public/images', $fileName);

            //strpos strposs

            // dd($path);
        }

        // $this-> validate($request, [ 내용] ) 해도 ㄱㅊ



        $input = array_merge($request->all(), ["user_id" => Auth::user()->id]);


        //IMAGE 가 있으면 $INPUT 에 image 항목 추가.
        if ($fileName) {

            // dd($path . ':' . strrpos($path, '/'));
            // $path = substr($path, strrpos($path, '/') + 1);

            // $path = time() . '_' . $path;
            // dd($path);  이미지이름 dd
            $input = array_merge($input, ['image' => $fileName]);
        }

        Post::create($input);


        /*
        $post = new Post;
        
        $post -> 어쩌구 저쩌구
        $post-> save() 대신에..

        Post::create();
        를 썼어요
        이때 mass assignment (대량 할당 외 처리)로 기술해야함
        
        대응되는 eloquent model 에 white list 인  protected $fillable -->>  에 기술하지 않으면 , 사용하지않을 칼럼명 지정

        명시적으로 정의된 컬럼외에는 배열에 값이 있어도 무시하게 되므로 description 에 설정한 값은 입력되지 않는다
        반대는 guarded
        */

        /*
        $request->all(): ['title'=> '어쩌구' , 'content'=> '저쩌구', 'user_id'=>Auth....=>1]
        php 의 배열 합체 메서드!!
        
        */

        return redirect()->route('posts.index', ['posts' => $input]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        //id 에 해당하는 Post 를 데이터베이스에서 인출하고
        // 그 놈을 상세보기에 view 로 전달.

        $post = Post::find($id);

        return view('bbs.show', ['post' => $post]);
        //pk 로 찾음.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);
        return view('bbs.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate(['title' => 'required|min:3', 'content' => 'required|min:10']);
        $post = Post::find($id);


        $post->title = $request->title;
        $post->content = $request->content;


        // if ($request->image) {
        //     $post->image  = $request->image;
        // } 
        //수정했을때도 이미지 남아있을 필요 o
        $post->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {

        $post = Post::find($post);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
