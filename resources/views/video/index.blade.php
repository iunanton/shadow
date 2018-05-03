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
    @forelse ($videos as $video)
        <div class="card mb-3">
            <div class="card-body row">
                <div class="col-md-4">
                    @if (in_array($video->status, [0, 1]))
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                    @else
                    <a href="{{ action('VideoController@show', $video->id) }}">
                        <img class="img-fluid poster" src="{{ asset('/video/'.$video->id.'/poster.jpg') }}" alt="poster">
                    </a>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12 text-muted"><strong>Public access</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 text-muted">Title:</div>
                        <div class="col-lg-9 col-sm-8">{{ $video->title }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 text-muted">Status:</div>
                        <div class="col-lg-9 col-sm-8">
                            @switch ($video->status)
                                @case(0)
                                    <span class="badge badge-primary">Pending</span>
                                    @break

                                @case(1)
                                    <span class="badge badge-warning">Processing</span>
                                    @break

                                @case(2)
                                    <span class="badge badge-warning">Partially&nbsp;ready</span>
                                    @break

                                @case(3)
                                    <span class="badge badge-success">Done</span>
                                    @break

                                @case(4)
                                    <span class="badge badge-danger">Error</span>
                                    @break

                                @default
                                    <span class="badge badge-secondary">{{ $item->status }}</span>
                            @endswitch
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 text-muted">Quality:</div>
                        <div class="col-lg-9 col-sm-8">{{ $video->max_quality }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 text-muted">Created at:</div>
                        <div class="col-lg-9 col-sm-8">{{ $video->created_at }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 text-muted">Updated at:</div>
                        <div class="col-lg-9 col-sm-8">{{ $video->updated_at }}</div>
                    </div>
                    <a href="{{ action('VideoController@edit', $video->id) }}" class="btn btn-primary mt-2">Edit</a>
                    <a href="{{ action('VideoController@destroy', $video->id) }}" class="btn btn-secondary mt-2">Delete</a>
                </div>
            </div>
        </div>
    @empty
        <div class="card mb-3">
            <div class="card-body">
                <div class="card-text">No video yet. <a href="{{ action('VideoController@create') }}">Upload first</a></div>
            </div>
        </div>
    @endforelse
    <!--Pagination-->
    <nav aria-label="pagination">
        {{ $videos->links() }}
    </nav>
</div>
@endsection
