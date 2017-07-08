require('./bootstrap');
window.Vue = require('vue');
import router from './route.js'

const app = new Vue({
    el: '#app',
    router
});

