@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Edit profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ action('VideoController@update', $video->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group form-check">
                            <input id="public" type="checkbox" class="form-check-input" name="public"
                            @if ($video->public)
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="public">Public</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

