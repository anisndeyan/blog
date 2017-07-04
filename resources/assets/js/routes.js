import VueRouter from 'vue-router';
import login from './components/login';
import registration from './components/registration';




//console.log(VueRouter);


let routes =[
	{ path:'/', component: login},
	{ path:'/registration', component: registration}
];
// let router = new VueRouter({routes});


 // export {routes as default};

export default new VueRouter({
	routes
})