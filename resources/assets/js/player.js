
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.HELP_IMPROVE_VIDEOJS = false;

require('videojs-ie8');

videojs = require('video.js');
require('dashjs');
require('videojs-contrib-dash');
require('videojs-hotkeys');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#player'
});

var player = videojs('video', {
   controls: true,
   //fluid: true,
   poster: "/poster.jpg"
});

player.ready(function() {
    this.src({
        src: "/manifest.mpd",
        type: 'application/dash+xml'
    });
    this.hotkeys({
        volumeStep: 0.1,
        seekStep: 5,
        enableVolumeScroll: false,
        enableModifiersForNumbers: false
    });
});
