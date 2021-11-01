<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory; //trait

    protected $fillable = [
        'comment' => 'required|max:100',

    ];

    public function user()
    {
        //comment 입장에서 연결된 
        //belongsTo 관계메서드를 통해 연결시키면 ㅇ

        return $this->belongsTo(User::class, "user_id");
        /*
            select * from users
            where id = $this.user.id
            만약에 관례안따르면 pk줘야함
        */
    }
}
