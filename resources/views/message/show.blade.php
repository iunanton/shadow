@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <video-player manifest="{{ url('/message/' . $message->id . '/manifest.mpd') }}" poster="{{ url('/message/' . $message->id . '/poster.jpg') }}"></video-player>
            <div>
                <h2>{{ $message->title }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
