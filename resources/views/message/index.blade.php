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
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @forelse ($messages as $message)
                <div class="card mb-3">
                    <div class="card-body row">
                        <div class="col-2">
                            <a href="{{ action('ProfileController@show', $message->sender->username) }}">
                                <img class="img-fluid" src="{{ asset('/images/default.png') }}" alt="{{ $message->sender->username }}">
                            </a>
                        </div>
                        <div class="col-9">
                            <h3 class="mb-1" style="display:inline-block">
                                <a href="{{ action('ProfileController@show', $message->sender->username) }}">{{ $message->sender->name }}</a>
                            </h3>
                            <p class="mb-1" style="display:inline-block">{{ $message->created_at }}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ action('MessageController@show', $message->id) }}">
                                        <img class="img-fluid poster" src="{{ asset('/message/'.$message->id.'/poster.jpg') }}" alt="poster">
                                    </a>
                                </div>
                            </div>
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
    </div>
</div>
@endsection
