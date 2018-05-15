@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form id="form" method="POST" action="{{ action('MessageController@store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="recipient" value="{{ $recipient->username }}">
                        <input id="video" type="hidden" name="video" value="">
                    </form>
                    <h3>Message for {{ $recipient->name }}</h3>
                    <div>
                        <video id="feedback" class=""></video>
                    </div>
                    <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div>
                        <button id="button-record" class="btn btn-danger">Record</button>
                        <button id="button-pause" class="btn btn-danger" style="display: none;">Pause</button>
                        <button id="button-resume" class="btn btn-danger" style="display: none;">Resume</button>
                        <button id="button-stop" class="btn btn-secondary" disabled>Stop</button>
                        <button id="button-submit" class="btn btn-secondary" disabled>Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
(function(){

var constraints = { video: { height: 480 }, audio: true };
var localStream;
var chunks = [];

if (navigator.mediaDevices === undefined) {
    navigator.mediaDevices = {};
}

if (navigator.mediaDevices.getUserMedia === undefined) {
    navigator.mediaDevices.getUserMedia = function(constraints) {
        var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        if (!getUserMedia) {
            return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
        }
        return new Promise(function(resolve, reject) {
            getUserMedia.call(navigator, constraints, resolve, reject);
        });
    }
}
	
navigator.mediaDevices.getUserMedia(constraints)
.then(function(stream) {
    localStream = stream;
    feedback.muted = true;
    if ("srcObject" in feedback) {
        feedback.srcObject = stream;
    } else {
        feedback.src = window.URL.createObjectURL(stream);
    }
    feedback.onloadedmetadata = function(e) {
        feedback.play();
    };

    var buttonRecord = document.getElementById('button-record');
    var buttonPause = document.getElementById('button-pause');
    var buttonResume = document.getElementById('button-resume');
    var buttonStop = document.getElementById('button-stop');
    var buttonSubmit = document.getElementById('button-submit');

    var mediaRecorder = new MediaRecorder(stream);

    buttonRecord.onclick = function() {
        mediaRecorder.start();
        console.log(mediaRecorder.state);
        console.log("recorder started");
        this.style.display = "none";
        buttonPause.style.display = "inline-block";
        buttonStop.disabled = false;
    }

    buttonPause.onclick = function() {
        mediaRecorder.pause();
        console.log(mediaRecorder.state);
        console.log("recorder paused");
        this.style.display = "none";
        buttonResume.style.display = "inline-block";
    }

    buttonResume.onclick = function() {
        mediaRecorder.resume();
        console.log(mediaRecorder.state);
        console.log("recorder resumed");
        this.style.display = "none";
        buttonPause.style.display = "inline-block";
    }

    buttonStop.onclick = function() {
        mediaRecorder.stop();
        console.log(mediaRecorder.state);
        console.log("recorder stopped");
        buttonPause.disabled = true;
        buttonResume.disabled = true;
        buttonSubmit.disabled = false;
    }

    buttonSubmit.onclick = function() {
        console.log("submit pressed");
        document.getElementById('form').submit();
    }

    mediaRecorder.onstop = function(e) {
        console.log("data available after MediaRecorder.stop() called.");
        localStream.getTracks().forEach(function (track) {
            track.stop();
        });
        var blob = new Blob(chunks, { 'type' : 'video/mp4' });
        chunks = [];

        if ("srcObject" in feedback) {
            feedback.srcObject = null;
        } else {
            feedback.src = null;
        }

        feedback.muted = false;
        feedback.controls = true;
        feedback.onloadedmetadata = null;
        feedback.src = window.URL.createObjectURL(blob);

        var reader = new FileReader();
        reader.onload = function() {
            document.getElementById('video').value = reader.result;
        };
        reader.readAsDataURL(blob);

      console.log("recorder stopped");
    }

    mediaRecorder.ondataavailable = function(e) {
      chunks.push(e.data);
    }
})
.catch(function(err) {
    console.log(err.name + ": " + err.message);
});
})();
</script>
@endsection
