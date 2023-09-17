@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Followings') }}</div>

                <div class="card-body">
                    <div class="mt-2 row">
                        @foreach ($user->followings as $following)
                            <div class="col-1"><a href="/profile/{{ $following->user->id }}"><img class="rounded-circle" style="width: 50px" src="{{ asset($following->image?? 'storage/images/profile.png') }}" alt=""></a></div>
                            <div class="col-5">{{ $following->user->username }}</div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
