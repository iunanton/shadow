
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

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
Vue.component('video-player', require('./components/VideoPlayer.vue'));
Vue.component('height-input', require('./components/HeightInput.vue'));
Vue.component('weight-input', require('./components/WeightInput.vue'));

const app = new Vue({
    el: '#app',
    data: {
        user: window.user,
    },
    methods: {
        myFunc() {
            console.log("Call myFunc()");
            if (this.user === null) {
                console.log("user is null");
                return;
            }
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "/api/user", true);
            xhttp.setRequestHeader("Accept","text/json");
            xhttp.setRequestHeader("Authorization","Bearer " + this.user.api_token);
            xhttp.send();
        },
        getUser() {
            console.log("Call getUser()");
            if (this.user === null) {
                console.log("user is null");
                return;
            }
            axios.get('/api/user', {headers: {'Authorization': 'Bearer ' + this.user.api_token }})
                 .then((responce) => {
                     console.log(responce.data);
                 })
                 .catch(function (error) {
                     console.log(error);
                 });
        }
    }
});
