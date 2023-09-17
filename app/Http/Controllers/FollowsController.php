<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;



class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user){
        return view('follows.index')->with(['user'=>$user]);
    }

    public function followers(User $user){
        return view('follows.follower')->with(['user'=>$user]);
    }

    public function store(Profile $profile)
    {
        return auth()->user()->followings()->toggle($profile);
    }
}
