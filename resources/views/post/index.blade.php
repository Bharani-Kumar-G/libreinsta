@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-5 row">
                                <div class="col-1"><a href="/profile/{{ $post->user->id }}"><img style="width: 50px" class="rounded-circle" src="{{ asset($post->user->profile->image ?? "storage/images/profile.png") }}" alt=""></a></div>
                                <div class="col-5 ms-5">
                                    <span>{{ $post->user->username }}</span>
                                    
                                    <span>
                                        @if(auth()->user()->id !== $post->user->id)
                                            <div style="float: right"><follow-button profile-id="{{ $post->user->profile->id }}" follows="{{ $follows }}"></follow-button></div>    
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <img style="width: 400px;" src="{{ asset($post->image) }}" alt="post">
                                    <div class="d-flex">
                                        <span><like-button post-id="{{ $post->id }}" likes="{{ $likes }}" like-count="{{ $post->likes->count() }}"></like-button></span>
                                        <span><i class="fa-solid fa-comment" style="color: #9141ac;" onclick="(()=>{
                                            if(document.getElementById('comment').style.display == 'none'){
                                                document.getElementById('comment').style.display = 'block'
                                            }
                                            else{
                                                document.getElementById('comment').style.display = 'none'
                                            }
                                        })()"></i></span>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-2">
                             <div class="col-3">
                                <div><p>{{ $post->caption }}</p></div>
                            <a href="/post/edit/{{ $post->id }}"><div class="btn btn-primary">
                                Edit
                            </div></a>
                            <div>
                        <form action="{{ route('post.delete') }}" method="POST">
                            @csrf 
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </div>
                        
                    </div>
                        </div>
                    </div>
                    <div id="comment" style="display: none;">
                        @foreach ($comments as $comment)
                            <div class="mb-4">
                                @if($comment->image)
                                    <img src="{{ asset($comment->image) }}" alt="" style="width: 200px">
                                @endif
                                <div>
                                    {{ $comment->comment }}
                                    
                                </div>
                                <span><like-comment-button comment-id="{{ $comment->id }}" likes="{{ $likes }}" like-count="{{ $comment->likes->count() }}"></like-comment-button></span>
                                
                            </div>
                        @endforeach
                        <div  class="w-75" >
                            <form action="/post/comment" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <span><input type="file" class="custom-file-label" style="display: none" id="file-input" name="image"></span>
                            <label class="custom-file-label" for="file-input">
                                <i class="fa-solid fa-upload" style="color: #9141ac;">Send Image</i>
                              </label>
                                <textarea name="comment" cols="50" rows="2"></textarea>
                                <input type="submit" value="comment">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
