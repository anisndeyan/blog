var app = angular.module("app",["ui.router", "ngFileUpload"]);

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
      //cateegories 

    .state('createCategory', {
        url: "/category/create",
        templateUrl : "views/category/create.html",
        controller: 'CategoryController'
    })

    .state("myCategory", {
        url: "/index",
        templateUrl : "views/category/my.html",
        controller: 'CategoryController'
    })

    .state("allCategory", {
        url: "/category/all",
        templateUrl : "views/category/all.html",
        controller: 'CategoryController'
    })

   	.state("editCategory", {
        url: "/category/:id/edit",
        templateUrl : "views/category/edit.html",
        controller: 'CategoryController'
    })

    //posts

    .state("createPost", {
        url: "/post/create",
        templateUrl : "views/post/create.html",
        controller: 'PostController'
    })
	.state("myPost", {
        url: "post/index",
        templateUrl : "views/post/index.html",
        controller: 'PostController'
    })
    .state("allPost", {
        url: "/post/all",
        templateUrl : "views/post/all.html",
        controller: 'PostController'
    })
    .state("editPost", {
        url: "/post/:id/edit",
        templateUrl : "views/post/edit.html",
        controller: 'PostController'
    })
     .state("categoryPost", {
        url: "/category/:id/post",
        templateUrl : "views/category/post.html",
        controller: 'CategoryController'
    })

})
