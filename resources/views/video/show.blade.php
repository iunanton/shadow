@extends('layouts.player')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Video</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    VideoController&commat;show<br>
                    <video id="video" class="video-js vjs-16-9 vjs-big-play-centered"></video>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
