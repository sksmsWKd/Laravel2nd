<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function writer()
    {





        // User <-> Post 의 relationship
        // 1:N
        // User 는 hasMany posts
        // Post는 belongsTo user

        return  $this->belongsTo(User::class, "user_id");
        /*

        select p.*,u.*
        from users u , posts p 
        inner join on u.id = p.user_id

        */
    }


    protected $fillable = [
        "title",
        "content",
        "user_id",
        "image"

        //parameter 로 많이많이와도, 여기 명시될 칼럼만 변경시켜줌
    ];
}
