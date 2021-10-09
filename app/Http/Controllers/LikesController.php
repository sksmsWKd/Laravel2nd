<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class LikesController extends Controller
{
    // 1.로그인한 사용자의 좋아요.취소 요청 처리
    public function store(Post $post)
    {
        return $post->likes()->toggle(auth()->user());
    }
}
