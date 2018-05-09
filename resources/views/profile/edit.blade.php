@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
<form>
  <div class="form-group">
    <label for="height">Height</label>
    <input type="range" class="form-control-range" id="height">
  </div>
  <div class="form-group">
    <label for="weight">Weight</label>
    <input type="range" class="form-control-range" id="weight">
  </div>
  <div class="form-group">
    <label for="comment">Comment:</label>
    <textarea class="form-control" rows="5" id="comment"></textarea>
  </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

