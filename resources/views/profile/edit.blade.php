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
                    <form method="POST" action="{{ action('ProfileController@update', 'iunanton') }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group form-check">
                            <input id="displayDOB" type="checkbox" class="form-check-input" name="displayDOB">
                            <label class="form-check-label" for="displayDOB">Display my age</label>
                        </div>
                        <div class="form-group">
                            <label for="height">Height: @{{ 1.2 + 0.01 * height }}</label>
                            <input id="height" v-model="height" type="range" class="form-control-range" name="height">
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight: @{{ 35 + 0.5 * weight }}</label>
                            <input id="weight" v-model="weight" type="range" class="form-control-range" name="weight">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" class="form-control" rows="5" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

