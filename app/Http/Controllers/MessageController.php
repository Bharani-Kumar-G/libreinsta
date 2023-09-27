<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class MessageController extends Controller
{
    public function index(){
        $authenticatedUser = Auth::user();

        $contacts = User::whereHas('sent', function ($query) use ($authenticatedUser) {
            $query->where('receiver_id', $authenticatedUser->id);
        })->orWhereHas('received', function ($query) use ($authenticatedUser) {
            $query->where('sender_id', $authenticatedUser->id);
        })->get();
        $lastMessage = Message::whereHas('sender', function ($query) use ($authenticatedUser) {
            $query->where('id', $authenticatedUser->id);
        })->orWhereHas('receiver', function ($query) use ($authenticatedUser) {
            $query->where('id', $authenticatedUser->id);
        })->orderBy('created_at', 'desc')->first();
        return view('message.index')->with(['contacts'=>$contacts, 'lastMessage'=>$lastMessage]);
    }

    public function show(User $user){
        $sent = auth()->user()->sent->where('receiver_id', $user->id);
        $received = auth()->user()->received->where('sender_id', $user->id);
        $messages = $sent->concat($received)->sortBy('created_at');
        
        return view('message.view')->with(['messages'=>$messages,'user'=>$user]);
    }

    public function store(Request $request){
        $request->validate([
            'text' => 'required_without:image_path',
            'image_path' => 'required_without:text|image',
        ]);
        $data = $request->all();
        if(!empty($data['image_path'])){
            $filename = bin2hex(random_bytes(32));
            $path = public_path("/storage/images/messages/".$filename);
            $image = Image::make($data['image_path']);
            $image->resize(1200,1200);
            $image->save($path);
            $folderPath = public_path("/storage/images/messages/");
            if (!File::exists($folderPath)) {
                // The folder doesn't exist; create it
                File::makeDirectory($folderPath, 0755, true, true);
            }
        }
        
        Message::create([
            'id'=>bin2hex(random_bytes(32)),
            'sender_id'=>auth()->user()->id,
            'receiver_id'=>$data['user_id'],
            'text'=>$data['text'],
            'image_path'=>!empty($data['image_path'])?"storage/images/messages/".$filename:null,
        ]);

        return redirect('/message/'.$data['user_id']);
    }

    public function delete(Request $request){
        $data = $request->all();
        $messages1 = auth()->user()->sent->where('receiver_id', $data['user_id']);
        $messages2 = auth()->user()->received->where('sender_id', $data['user_id']);
        $messages = $messages1->concat($messages2);
        foreach ($messages as $key => $value) {
            if($key == 'image_path'){
                if($value){
                    unlink($value);
                }
            }
        }
        $messages->each(function ($model) {
            $model->delete();
        });
        return redirect('/message');
    }
}
