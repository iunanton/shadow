<template>
    <video id="video" class="video-js vjs-16-9 vjs-big-play-centered mb-3"></video>
</template>

<script>
    export default {
        props: ['manifest', 'poster'],
        mounted() {
            window.HELP_IMPROVE_VIDEOJS = false;

            var player = videojs('video', {
               controls: true,
               //fluid: true,
               poster: this.poster
            });

            var manifest = this.manifest;

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
