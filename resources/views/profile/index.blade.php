@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-2"><img class="rounded-circle" style="width: 150px" src="{{ $user->profile->image ?? "storage/images/profile.png" }}" alt=""></div>
            <div class="col-4">
                <div>{{ $user->username }}</div>
                <div>{{ $user->profile->title }}</div>
                <div>{{ $user->profile->bio }}</div>
                <div>{{ $user->profile->url }}</div>
                <div>
                    <span class="ms-5">
                        <a href="{{ route('profile.edit') }}">Edit Profile</a>
                    </span>
                    <span class="ms-5">
                        <a href="{{ route('profile.image.update') }}">Edit Profile Image</a>
                    </span>
                </div>
            </div>

        </div>
        <div class="mt-5">
            <div>
                <span class="ms-5" style="float: right">
                    <a href="{{ route('post.create') }}">Add Post</a>
                </span>
            </div>
            @foreach ($user->post as $post)
                <img class="ms-5 mb-5" style="width: 250px" src="{{ $post->image }}" alt="">
            @endforeach
        </div>
    </div>
</div>
@endsection
