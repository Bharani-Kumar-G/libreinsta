<?php

namespace App\Http\Controllers;
use App\Models\Profile;



class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Profile $profile)
    {
        return auth()->user()->followings()->toggle($profile);
    }
}
