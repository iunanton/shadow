@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="text-center mb-4">
                <img class="img-fluid" src="{{ asset('/square.png') }}" alt="photo">
            </div>
            <h3 class="mb-4">杜建军</h3>
            <a href="#" class="btn btn-block btn-primary mb-4"><strong>Say "Hi!" to him</strong></a>
        </div>
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('About me') }}
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <h5>Basic</h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">Age: 28</li>
                            <li class="list-inline-item">Height: 180</li>
                            <li class="list-inline-item">Weigth: 70</li>
                            <li class="list-inline-item">BMI: 20</li>
                        </ul>
                    </div>
                    <div class="card-text">
                        <h5>Description</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id sapien eu augue tincidunt auctor consequat ac diam. In sit amet quam nunc. Proin quis tellus dapibus, pulvinar mi et, interdum dolor. Maecenas finibus volutpat ex quis condimentum. Quisque interdum felis purus, id lobortis ligula interdum nec. Morbi et massa sollicitudin, commodo dolor eget, rhoncus leo. Quisque tempus sagittis fringilla.</p>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('Public videos') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($videos as $video)
                        <a class="col-md-3 mb-3" href="{{ url('/video/' . $video->id) }}"><img class="img-fluid poster" src="{{ url('/video/' . $video->id . '/poster.jpg') }}" alt="poster"></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
