<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post){
        return view('post.index')->with(['post'=>$post]);
    }

    public function edit(Post $post){
        return view('post.edit')->with(['post'=>$post]);
    }

    public function create(){
        return view('post.create');
    }

    public  function store(Request $request){
        $data = $request->all();
        $type = explode('/',explode(';', $data['image'])[0])[1];
        $base64 = explode(',', $data['image'])[1];
        $base64 = base64_decode($base64);
        $filename = bin2hex(random_bytes(32)).".".$type;
        $path = public_path("/storage/images/post/".$filename);
        $image = Image::make($base64);
        $image->resize(1200,1200);
        $image->save($path);
        Post::create([
            'id' => bin2hex(random_bytes(32)),
            'user_id' => auth()->user()->id,
            'caption' => $data['caption'],
            'image' => "storage/images/post/".$filename
        ]);
        return redirect(route('home'));
    }

    public function update(Request $request){
        $data = $request->all();
        $type = explode('/',explode(';', $data['image'])[0])[1];
        $base64 = explode(',', $data['image'])[1];
        $base64 = base64_decode($base64);
        $filename = bin2hex(random_bytes(32)).".".$type;
        $path = public_path("/storage/images/post/".$filename);
        $image = Image::make($base64);
        $image->resize(1200,1200);
        $image->save($path);
        $post = Post::find($data['id'])->first();
        if($post->image){
            unlink($post->image);
        }
        $post->caption = $data['caption'];
        $post->image = 'storage/images/post/'.$filename;
        $post->save();
        return redirect(route('home'));
    }

    public function delete(Request $request){
        $data = $request->all();
        $post = Post::find($data['id'])->first();
        if($post->image){
            unlink($post->image);
        }
        $post->delete();
        return redirect(route('home'));
    }
}
