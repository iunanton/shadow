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
            <video-player manifest="{{ action('MessageController@getAsset', [$message->id, 'manifest.mpd']) }}" poster="{{ action('MessageController@getAsset', [$message->id, 'poster.jpg']) }}"></video-player>
            <div>
                <h2>{{ $message->title }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
