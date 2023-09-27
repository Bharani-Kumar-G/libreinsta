<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CommentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'comment' => 'required_without:image',
            'image' => 'required_without:comment|image',
        ]);
        $data = $request->all();
        if(!empty($data['image'])){
            $filename = bin2hex(random_bytes(32));
            $path = public_path("/storage/images/comment/".$filename);
            $image = Image::make($data['image']);
            $image->resize(1200,1200);
            $image->save($path);
            $folderPath = public_path("/storage/images/comment/");
            if (!File::exists($folderPath)) {
                // The folder doesn't exist; create it
                File::makeDirectory($folderPath, 0755, true, true);
            }
        }
        Comment::create([
            'id' => bin2hex(random_bytes(32)),
            'post_id' => $data['post_id'],
            'comment' => $data['comment'],
            'image' => !empty($data['image'])?"/storage/images/comment/" . $filename : null,
        ]);
        return redirect('/post/index/'. $data['post_id']);
    }

    public function getLikesCount(Comment $comment)
    {
        $data = $comment->likes->count();

        return response()->json(['data' => $data]);
    }

    public function isLiked(Comment $comment)
    {
        $data = (auth()->check()) ? auth()->user()->likedComment->contains($comment->id): false;

        return response()->json(['data' => $data]);
    }
}
