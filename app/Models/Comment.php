<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name','content','user_id ','post_id'];
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
