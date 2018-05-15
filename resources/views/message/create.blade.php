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
                    <div id="progress" class="progress mb-2" style="height: 5px;">
                        <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div>
                        <button id="button-record" class="btn btn-danger">Record</button>
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
    var buttonStop = document.getElementById('button-stop');
    var buttonSubmit = document.getElementById('button-submit');

    var maxDuration = 5000;
    var progressBarTimeout = 250;

    var progressBarValue = 0;
    var progressBar = document.getElementById('progress-bar');

    var mediaRecorder = new MediaRecorder(stream);

    function updateProgressBar() {
        if (mediaRecorder.state == "inactive") return;
        progressBarValue = progressBarValue + progressBarTimeout * 100 / maxDuration;
        progressBar.style.width = progressBarValue + "%";
        setTimeout(updateProgressBar, progressBarTimeout);
    }

    function startRecording() {
        mediaRecorder.start();
        console.log(mediaRecorder.state);
        console.log("recorder started");
        this.disabled = true;
        buttonStop.disabled = false;
        updateProgressBar();
    }

    function stopRecording() {
        if (mediaRecorder.state == "inactive") return;
        mediaRecorder.stop();
        console.log(mediaRecorder.state);
        console.log("recorder stopped");
        buttonStop.disabled = true;
        buttonSubmit.disabled = false;
    }

    buttonRecord.onclick = startRecording;

    buttonStop.onclick = stopRecording;

    buttonSubmit.onclick = function() {
        console.log("submit pressed");
        document.getElementById('form').submit();
    }

    mediaRecorder.onstart = function() {
        setTimeout(function() {
            stopRecording();
        }, maxDuration);
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
