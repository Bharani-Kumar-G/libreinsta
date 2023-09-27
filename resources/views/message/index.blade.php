@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Messages') }}</div>
                    @foreach ($contacts as $contact)
                        
                            <div class="mb-4">
                                <a style="display: inline" href="/message/{{ $contact->id }}">
                                    <img class="rounded-circle mb-3" style="width: 50px" src="{{ asset($contact->profile->image ?? "storage/images/profile.png") }}" alt="">
                                    <div style="display: inline;" class="ms-5">{{ $contact->username }}</div>
                                </a>
                                <form action="/message/delete" method="post">
                                    @csrf
                                    <input type="hidden" style="display:inline;" name="user_id" value="{{ $contact->id }}">
                                                                               
                                    <button style="float: right;display:inline;" class="btn  btn-danger">Delete</button>
                                </form>
                                @if($lastMessage->sender->id === auth()->user()->id)
                                    @if($lastMessage->receiver->id === $contact->id)
                                        <div class="m-auto ms-5">{{ $lastMessage->text??'media sent' }}</div>
                                        
                                    @endif
                                @else
                                    @if($lastMessage->sender->id === $contact->id)
                                        <div class="m-auto ms-5">{{ $lastMessage->text??'media received' }}</div>
                                    @endif
                                @endif
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
