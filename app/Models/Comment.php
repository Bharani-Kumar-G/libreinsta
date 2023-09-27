<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['id','post_id', 'comment', 'image'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class);
    }
}
