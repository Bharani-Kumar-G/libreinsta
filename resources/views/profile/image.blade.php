@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile Image') }}</div>

                
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.image.store') }}">
                        @csrf

                        <image-cropper></image-cropper>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
