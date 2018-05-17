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
                    <form method="POST" action="{{ action('ProfileController@update', $user->username) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group form-check">
                            <input id="displayDOB" type="checkbox" class="form-check-input" name="displayDOB"
                            @if ($user->profile->displayDOB)
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="displayDOB">Display my age</label>
                        </div>
                        <height-input value="{{ $user->profile->height }}"></height-input>
                        <weight-input value="{{ $user->profile->weight }}"></weight-input>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" class="form-control" rows="5" name="description">{{ $user->profile->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

