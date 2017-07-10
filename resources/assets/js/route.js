// require('./bootstrap');
import VueRouter from 'vue-router';
import login from './components/login';
import registration from './components/registration';
import home from './components/home';
import categoryCreate from './components/category/create';
import categoryIndex from './components/category/index';
import categoryShow from './components/category/show';
import categoryEdit from './components/category/edit';
import postCreate from './components/post/create';
import postIndex from './components/post/index';
import postShow from './components/post/show';
import postEdit from './components/post/edit';


let routes = [
	{ path: '/login', component: login },
	{ path: '/registration', component: registration },
	{ path: '/home', component: home },
	{ path: '/category/create', component: categoryCreate },
	{ path: '/category/index', component: categoryIndex },
	{ path: '/category/show', component: categoryShow },
	{ path: '/category/:id/edit', component:categoryEdit},
	{ path: '/post/create', component: postCreate },
	{ path: '/post/index', component: postIndex },
	{ path: '/post/show', component: postShow },
	{ path: '/post/:id/edit', component:postEdit}
];

export default new VueRouter({
	routes
})