<?php

namespace App\Http\Controllers;
use App\Models\Post;



class LikePostController extends Controller
{
    public function store(Post $post)
    {
        return auth()->user()->liked()->toggle($post);
    }
}
