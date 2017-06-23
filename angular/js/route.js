var app = angular.module("app",["ui.router"]);

app.config(function($stateProvider, $urlRouterProvider) {
	
	$stateProvider
	.state('index', {
		url: "/"
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
	    templateUrl: "views/home/home.html",
        controller: 'HomeController'
    })
    .state('createCategory', {
        url: "/createcategory",
        templateUrl : "views/category/create.html",
        controller: 'CategoryController'
    })
    
})
