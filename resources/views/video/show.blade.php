@extends('layouts.player')

@section('content')
<div class="container text-center">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <video id="video" class="video-js vjs-16-9 vjs-big-play-centered"></video>
</div>
@endsection
