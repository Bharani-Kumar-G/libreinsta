@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post') }}</div>

                <div class="card-body">
                    <div class="mb-5 row">
                        <div class="col-1"><a href="/profile/{{ $post->user->id }}"><img style="width: 50px" class="rounded-circle" src="{{ asset($post->user->profile->image ?? "storage/images/profile.png") }}" alt=""></a></div>
                        <div class="col-5">
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
                            <div><p>{{ $post->caption }}</p></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <a href="/post/edit/{{ $post->id }}"><div class="btn btn-primary">
                            Edit
                        </div></a>
                        
                    </div>
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
    </div>
</div>
@endsection
