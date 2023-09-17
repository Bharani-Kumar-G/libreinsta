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

    public function index(){
        return view('follows.index')->with(['user'=>auth()->user()]);
    }

    public function followers(){
        return view('follows.follower')->with(['user'=>auth()->user()]);
    }

    public function store(Profile $profile)
    {
        return auth()->user()->followings()->toggle($profile);
    }
}
