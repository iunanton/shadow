@extends('layouts.app')

@section('content')
<div class="container">
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
                <a href="{{ action('VideoController@show', $item->id) }}">
                    <img class="card-img-top poster" src="{{ asset('/video/' . $item->id . '/poster.jpg') }}" alt="Poster">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-dark" href="{{ action('VideoController@show', $item->id) }}">{{ $item->title }}</a>
                    </h5>
                    <p class="card-text"><small><a href="{{ action('ProfileController@show', $item->user->username) }}">{{ $item->user->name }}</a></small></p>
                </div>
            </div>
        @endforeach
    </div>
    @endif
    <!--Pagination-->
    <nav aria-label="pagination">
        {{ $videos->links() }}
    </nav>
</div>
@endsection
