@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @foreach ($results as $result)
                        <a href="/profile/{{ $result->id }}"><div class="mb-4">
                            <img  class="rounded-circle mb-3" style="width: 50px" src="{{ asset($result->profile->image ?? "storage/images/profile.png") }}" alt="">
                                <div style="display: inline;" class="ms-5">{{ $result->username }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
