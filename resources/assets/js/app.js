require('./bootstrap');
window.Vue = require('vue');
import router from './route.js'

const app = new Vue({
    el: '#app',
    methods:{
		logout: function(){
			axios.get('/api/logout').then((response)=> {
				console.log(response);
    		})	
		}
	},
    router
});

