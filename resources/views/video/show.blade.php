@extends('layouts.player')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <video id="video" class="video-js vjs-16-9 vjs-big-play-centered mb-3"></video>
    <div>
        <h2>{{ $video->title }}</h2>
    </div>
</div>
@endsection
