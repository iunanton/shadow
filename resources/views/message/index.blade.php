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
    @forelse ($messages as $message)
        <div class="card mb-3">
            <div class="card-body row">
                <div class="col-md-4">
                    <a href="{{ action('MessageController@show', $message->id) }}">
                        <img class="img-fluid poster" src="{{ asset('/message/'.$message->id.'/poster.jpg') }}" alt="poster">
                    </a>
                </div>
            </div>
       </div>
    @empty
        <div class="card mb-3">
            <div class="card-body">
                <div class="card-text">No message yet.</div>
            </div>
        </div>
    @endforelse
    <!--Pagination-->
    <nav aria-label="pagination">
        {{ $messages->links() }}
    </nav>
</div>
@endsection
