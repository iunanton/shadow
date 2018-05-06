@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <video id="feedback"></video>
                    <div>
                        <button id="record" class="btn btn-danger">Record</button>
                        <button id="stop" class="btn btn-secondary">Stop</button>
                        <button id="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
(function(){

var constraints = { video: true, audio: true };
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
    if ("srcObject" in feedback) {
        feedback.srcObject = stream;
    } else {
        feedback.src = window.URL.createObjectURL(stream);
    }
    feedback.onloadedmetadata = function(e) {
        feedback.play();
    };

    var mediaRecorder = new MediaRecorder(stream);

    record.onclick = function() {
        mediaRecorder.start();
        console.log(mediaRecorder.state);
        console.log("recorder started");
        this.innerHTML = "Stop";
        this.onclick = function() {
            mediaRecorder.stop();
            console.log(mediaRecorder.state);
            console.log("recorder stopped");
        }
    }

    mediaRecorder.onstop = function(e) {
        console.log("data available after MediaRecorder.stop() called.");
        var blob = new Blob(chunks, { 'type' : 'video/mp4' });
        chunks = [];

        if ("srcObject" in feedback) {
            feedback.srcObject = blob;
        } else {
            feedback.src = window.URL.createObjectURL(blob);
        }

        feedback.controls = true;
        feedback.onloadedmetadata = null;

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
