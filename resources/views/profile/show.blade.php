@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="text-center mb-4">
                <img class="img-fluid" src="{{ asset('/images/default.png') }}" alt="photo">
            </div>
            <h3 class="mb-4">{{ $user->name }}</h3>
            <a href="{{ action('MessageController@create', $user->username) }}" class="btn btn-block btn-primary mb-4"><strong>Say "Hi!" to him</strong></a>
        </div>
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('About me') }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <h5>Basic</h5>
                        <ul class="list-inline">
                            @if ($user->profile->displayDOB)
                                <li class="list-inline-item">Age: {{ $user->profile->age }}</li>
                            @endif
                            <li class="list-inline-item">Height: {{ $user->profile->heightSI }}</li>
                            <li class="list-inline-item">Weight: {{ $user->profile->weightSI }}</li>
                            <li class="list-inline-item">BMI: {{ $user->profile->BMI }}</li>
                        </ul>
                    </div>
                    <hr>
                    <div class="card-text">
                        <h5>Description</h5>
                        @empty ($user->profile->description)
                        <p>Not specified yet.</p>
                        @else
                        <p>{{ $user->profile->description }}</p>
                        @endempty
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('Public videos') }}
                </div>
                <div class="card-body">
                    @if ($publicVideos->isEmpty())
                        {{ __('No public video yet.') }}
                    @else
                    <div class="row">
                        @foreach ($publicVideos as $video)
                        <a class="col-md-3 mb-3" href="{{ url('/video/' . $video->id) }}"><img class="img-fluid poster" src="{{ asset('/video/' . $video->id . '/poster.jpg') }}" alt="poster"></a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('Private videos') }}
                </div>
                <div class="card-body">
                    @if ($privateVideos->isEmpty())
                        {{ __('No private video yet.') }}
                    @else
                    <div class="row">
                        @foreach ($privateVideos as $video)
                        <a class="col-md-3 mb-3" href="{{ url('/video/' . $video->id) }}"><img class="img-fluid poster" src="{{ url('/video/' . $video->id . '/poster.jpg') }}" alt="poster"></a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
