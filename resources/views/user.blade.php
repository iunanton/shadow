@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-body row">
            <div class="col-md-3">
                <img class="img-fluid" src="{{ url('/square.png') }}" alt="photo">
            </div>
            <div class="col-md-9">
                <h3 class="card-title">정은주</h3>
                <p class="card-text text-muted">Age: 28</p>
                <p class="card-text text-muted">Height: 180</p>
                <p class="card-text text-muted">Weigth: 70</p>
                <p class="card-text text-muted">BMI: 20</p>
                <div class="card-subtitle text-muted">
                    <ul class="list-inline">
                        <li class="list-inline-item">Age: 28</li>
                        <li class="list-inline-item">Height: 180</li>
                        <li class="list-inline-item">Weigth: 70</li>
                        <li class="list-inline-item">BMI: 20</li>
                    </ul>
                </div>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id sapien eu augue tincidunt auctor consequat ac diam. In sit amet quam nunc. Proin quis tellus dapibus, pulvinar mi et, interdum dolor. Maecenas finibus volutpat ex quis condimentum. Quisque interdum felis purus, id lobortis ligula interdum nec. Morbi et massa sollicitudin, commodo dolor eget, rhoncus leo. Quisque tempus sagittis fringilla.</p>
                <a href="#" class="btn btn-primary">Leave message to him</a>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <h6 class="card-title">Public videos</h6>
            <div class="row">
                @foreach ($videos as $video)
                <a class="col-md-2" href="{{ url('/video/' . $video->id) }}"><img class="img-fluid" src="{{ url('/video/' . $video->id . '/poster.jpg') }}" alt="poster"></a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
