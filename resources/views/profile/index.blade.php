@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-2"><a href="/profile/{{ $user->id }}"><img class="rounded-circle" style="width: 150px" src="{{ asset($user->profile->image ?? "storage/images/profile.png") }}" alt=""></a></div>
            <div class="col-4">
                @if(auth()->user()->id !== $user->id)
                <div style="float: right"><follow-button profile-id="{{ $user->profile->id }}" follows="{{ $follows }}"></follow-button></div>    
                @endif
                
                <div>{{ $user->username }}</div>
                <div>{{ $user->profile->title }}</div>
                <div>{{ $user->profile->bio }}</div>
                <a href="{{ $user->profile->url }}" style="text-decoration: none"><div>{{ $user->profile->url }}</div></a>
                <div>
                    <span class="me-5">
                        <a href="{{ route('profile.edit') }}">Edit Profile</a>
                    </span>
                    <span class="me-5">
                        <a href="{{ route('profile.image.update') }}">Edit Profile Image</a>
                    </span>
                    <span class="me-5 mt-5" style="float: right">
                        <a href="/followings">Followings</a>
                    </span>
                    <span class="me-5 mt-5" style="float: right">
                        <a href="/followers">Followers</a>
                    </span>
                </div>
                
            </div>

        </div>
        <div class="mt-5">
            <div>
                <span class="ms-5" style="float: right;font-size:30px">
                    <a href="{{ route('post.create') }}">&CirclePlus;</a>
                </span>
            </div>
            @foreach ($user->posts as $post)
                <a href="/post/index/{{ $post->id }}"><img class="ms-5 mb-5" style="width: 250px" src="{{ asset($post->image) }}" alt=""></a>
            @endforeach
        </div>
    </div>
</div>
@endsection
