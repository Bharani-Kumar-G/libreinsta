@extends('layouts.app')
@php
    use Carbon\Carbon;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="/profile/{{ $user->id }}">
                        <div>
                            <img  class="rounded-circle mb-3" style="width: 50px" src="{{ asset($user->profile->image ?? "storage/images/profile.png") }}" alt="">
                            <div style="display: inline;" class="ms-5">{{ $user->username }}</div>
                        </div>
                    </a>
                </div>

                <div>
                    @foreach ($messages as $message)
                        
                    
                    <div class="row">
                        <div class="col-md-6">
                            
                            @if($message->receiver->id === auth()->user()->id)
                                <div class="left-div">
                                    <div class="bg-secondary">{{ $message->text }}</div>
                                    @if ($message->image_path != null)
                                        <img src="{{ asset($message->image_path) }}" width="250" alt="">
                                    @endif
                                    <p style="opacity: 0.5;" >{{ Carbon::parse($message->created_at)->format('d F Y H:i')}}</p>
                                </div>
                            @endif
                            
                        </div>
                        <br>
                        <div class="col-3" style="float:right; flex:3">
                            
                            @if($message->sender->id === auth()->user()->id)   
                                <div class="right-div">
                                    <div class="bg-primary">{{ $message->text }}</div>
                                    @if ($message->image_path != null)
                                        <img src="{{ asset($message->image_path) }}" width="250" alt="">
                                    @endif
                                        <p style="opacity: 0.5;" >{{ Carbon::parse($message->created_at)->format('d F Y H:i')}}</p>
                                </div>
                                
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <div class="fixed-bottom-div m-auto mt-5 w-90">
                        <form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <span><input type="file" class="custom-file-label" style="display: none" id="file-input" name="image_path"></span>
                            <label class="custom-file-label" for="file-input">
                                <i class="fa-solid fa-upload" style="color: #9141ac;">Send Image</i>
                              </label>
                            <span><textarea name="text"  cols="100" rows="1"></textarea></span>
                            <span><input type="submit" value="send"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
