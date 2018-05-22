<template>
    <video id="video" class="video-js vjs-16-9 vjs-big-play-centered mb-3"></video>
</template>

<script>
    export default {
        props: ['src'],
        mounted() {
            window.HELP_IMPROVE_VIDEOJS = false;

            var customCallback = function (player, mediaPlayer) {
                mediaPlayer.getDebug().setLogToBrowserConsole(false);
            };

            videojs.Html5DashJS.hook('beforeinitialize', customCallback);

            var player = videojs('video', {
               controls: true,
               //fluid: true,
               poster: this.src + '/poster.jpg'
            });

            var manifest = this.src + '/manifest.mpd';

            player.ready(function() {
                this.src({
                    src: manifest,
                    type: 'application/dash+xml'
                });
                this.hotkeys({
                    volumeStep: 0.1,
                    seekStep: 5,
                    enableVolumeScroll: false,
                    enableModifiersForNumbers: false
                });
            });
        }
    }
</script>
