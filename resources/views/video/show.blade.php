@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8 mb-3">
            <video-player manifest="{{ action('VideoController@getAsset', [$video->id, 'manifest.mpd']) }}" poster="{{ action('VideoController@getAsset', [$video->id, 'poster.jpg']) }}"></video-player>
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
            @foreach ($asideVideos as $item)
            <div class="row mb-2">
                <div class="col-6">
                    <a href="{{ action('VideoController@show', $item->id) }}">
                        <img class="img-fluid poster" src="{{ action('VideoController@getAsset', [$item->id, 'poster.jpg']) }}" alt="image">
                    </a>
                </div>
                <div class="col-6">
                    <h5><a class="text-dark" href="{{ action('VideoController@show', $item->id) }}">{{ str_limit($item->title, 32) }}</a></h5>
                    <p><small><a href="{{ action('ProfileController@show', $item->user->username) }}">{{ $item->user->name }}</a></small></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
