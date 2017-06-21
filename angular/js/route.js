var app = angular.module("app",["ui.router"]);

app.config(function($stateProvider, $urlRouterProvider) {
	
	$stateProvider
	.state('index', {
		url: ""
	})
	.state('register', {
        url: '/register',
        templateUrl: 'views/auth/registration.html'
    })
    .state('login', {
        url: '/login',
        templateUrl: 'views/auth/login.html'
    })
})
