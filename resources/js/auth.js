
window.Vue = require('vue/dist/vue.js');

import AppAuth from './components/auth/auth.vue';
import config from "./config";

import 'bootstrap/dist/css/bootstrap.min.css';
import 'font-awesome/css/font-awesome.min.css';


Vue.component('app-auth', AppAuth);

const app = new Vue({
    el: '#app',
    data: {
        config: config
    }
});