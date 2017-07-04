require('./bootstrap');
window.Vue = require('vue');

import exs from './components/Example';
import router from './routes.js'


const app = new Vue({
    el: '#app',
    router,
    components:{
    	app:exs
    }
});


// console.log(router);