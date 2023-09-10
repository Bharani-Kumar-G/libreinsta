<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        $user = auth()->user();
        return view('profile.index')->with(['user' => $user]);
    }

    public function index(User $user){
        return view('profile.index')->with(['user' => $user]);
    }
    
    public function edit(){
        if(!Profile::where('user_id', auth()->user()->id)->first()){
            Profile::create([
                'id' => bin2hex(random_bytes(32)),
                'user_id' => auth()->user()->id,
                'title' => auth()->user()->name,
            ]);
        }
        return view('profile.update');
    }

    public function update(Request $request){
        $request->validate([
            'title' => ['string', 'max:50'],
            'bio' => ['string', 'max:255'],
            'url' => ['url', 'max:300']
        ]);
        $data = $request->all();
        
        $profile = Profile::where('user_id', auth()->user()->id)->first();
        $profile->title = $data['title']??auth()->user()->name;
        $profile->bio = $data['bio'];
        $profile->url = $data['url'];
        $profile->save();
        return redirect(route('home'));
    }
}
