@extends('layouts.app')

@section('content')
<div class="container text-center">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($videos->isEmpty())
        <p>No videos found.</p>
    @else
    <div class="card-columns">
        @foreach ($videos as $item)
            <div class="card">
                <a href="{{ url('/video/' . $item->id) }}">
                    <img class="card-img-top poster" src="{{ asset('/video/' . $item->id . '/poster.jpg') }}" alt="Poster">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-dark" href="{{ url('/video/' . $item->id) }}">{{ $item->title }}</a>
                    </h5>
                    <p class="card-text"><small class="text-muted">{{ $item->user->name }}</small></p>
                </div>
            </div>
        @endforeach
    </div>
    @endif
    {{ $videos->links() }}
</div>
@endsection
