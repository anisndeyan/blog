var app = angular.module("app",["ui.router"]);

app.config(function($stateProvider, $urlRouterProvider) {
	
	$stateProvider
	.state('index', {
		url: ""
	})
	.state('register', {
        url: '/register',
        templateUrl: 'views/auth/registration.html',
        controller: 'AuthController'
    })
    .state('login', {
        url: '/login',
        templateUrl: 'views/auth/login.html',
        controller: 'AuthController'
    })
    .state('home', {
	    url: "/home",
	    templateUrl: "views/auth/home.html",
        controller: 'HomeController'
    })
})
