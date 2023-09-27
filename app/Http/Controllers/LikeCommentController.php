<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class LikeCommentController extends Controller
{
    public function store(Comment $comment)
    {
        return auth()->user()->likedComment()->toggle($comment);
    }
}
