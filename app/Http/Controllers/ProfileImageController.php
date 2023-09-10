<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(){
        return view('profile.image');
    }

    public function store(Request $request){
        
        $data = $request->all();
        $type = explode('/',explode(';', $data['image'])[0])[1];
        $base64 = explode(',', $data['image'])[1];
        $base64 = base64_decode($base64);
        $filename = bin2hex(random_bytes(32)).".".$type;
        $path = public_path("/storage/images/profile/".$filename);
        $image = Image::make($base64);
        $image->resize(1200,1200);
        $image->save($path);

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        $profile->image = "storage/images/profile/".$filename;
        $profile->save();

        return redirect(route('home'));
    }
}
