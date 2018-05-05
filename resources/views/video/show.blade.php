@extends('layouts.player')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8">
            <video id="video" class="video-js vjs-16-9 vjs-big-play-centered mb-3"></video>
            <div>
                <h2>{{ $video->title }}</h2>
                @if ($video->user_id == Auth::user()->id)
                    <div>
                        <a class="btn btn-primary" href="{{ action('VideoController@edit', $video->id) }}">Edit</a>
                        <a class="btn btn-secondary" href="{{ action('VideoController@destroy', $video->id) }}">Delete</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            @foreach ($videos as $item)
            <div class="row">
                <div class="col-6">
                    <a href="{{ url('/video/' . $item->id) }}">
                        <img class="img-fluid poster" src="{{ asset('/video/' . $item->id . '/poster.jpg') }}" alt="image">
                    </a>
                </div>
                <div class="col-6">
                    <h5><a class="text-dark" href="{{ url('/video/' . $item->id) }}">{{ $item->title }}</a></h5>
                    <p><small class="text-muted">{{ $item->user->name }}</small></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
