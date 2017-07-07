var app = angular.module("app",["ui.router", "ngFileUpload"]);
app.config(function($stateProvider, $urlRouterProvider) {
	
	$stateProvider

	.state('index', {
		url: "/"
	})
	.state('register', {
        url: '/register',
        templateUrl: 'views/auth/registration.html',
        controller: 'AuthController',
        data : {
            guest: true
        }
    })
    .state('login', {
        url: '/login',
        templateUrl: 'views/auth/login.html',
        controller: 'AuthController',
        data : {
            guest: true
        }
    })
    .state('home', {
	    url: "/home",
	    templateUrl: "views/home/home.html",
        controller: 'HomeController',
         data : {
            guest: false
        }
    })

    //cateegories 

    .state('createCategory', {
        data : {
            guest: false
        },
        url: "/category/create",
        templateUrl : "views/category/create.html",
        controller: 'CategoriesController',
        data : {
            guest: false
        },
        resolve : {
            data: function($http){
                return null;
            }
        }
    })

    .state("myCategories", {
        url: "category/index",
        templateUrl : "views/category/index.html",
        controller: 'CategoriesController',
        data : {
            guest: false
        },
        resolve : {
            data: function($http){
                return $http.get('/api/category/index');
            }
        }
    })

    .state("allCategories", {
        url: "/category/show",
        templateUrl : "views/category/show.html",
        controller: 'CategoriesController',
        data : {
            guest: false
        },
        resolve : {
            data: function($http){
                return $http.get('/api/category/show');
            }
        }
    })

   	.state("editCategory", {
        url: "/category/:id/edit",
        templateUrl : "views/category/edit.html",
        controller: 'CategoriesController',
        data : {
            guest: false
        },
        resolve : {
            data: function($http){
                return null;
            }
        }
    })
    .state("categoryPost", {
        url: "/category/:id/post",
        templateUrl : "views/category/post.html",
        controller: 'CategoriesController',
        data : {
            guest: false
        },
        resolve : {
            data: function($http){
                return null;
            }
        }
    })

    //posts

    .state("createPost", {
        url: "/post/create",
        templateUrl : "views/post/create.html",
        controller: 'PostsController',
        data : {
            guest: false
        },
        resolve : {
            data: function($http){
                return null;
            }
        }
    })

	.state("myPosts", {
        url: "post/index",
        templateUrl : "views/post/index.html",
        controller: 'PostsController',
        data : {
            guest: false
        },
        resolve : {
            data: function($http){
                return $http.get('/api/post/index');
            }
        }
    })
    .state("allPosts", {
        url: "/post/show",
        templateUrl : "views/post/show.html",
        controller: 'PostsController',
        data : {
            guest: false
        },
         resolve : {
            data: function($http){
                return $http.get('/api/post/show');
            }
        }
    })
    .state("editPost", {
        url: "/post/:id/edit",
        templateUrl : "views/post/edit.html",
        controller: 'PostsController',
        data : {
            guest: false
        },
        resolve : {
            data: function($http){
                return null;
            }
        }
    })
})

app.run(['$rootScope', '$state', function($rootScope, $state){
    $rootScope.$on('$stateChangeStart', 
        function(event, toState, toParams, fromState) {
            $rootScope.loggedIn = localStorage['loggedIn'];
            $rootScope.user = localStorage['user'];
            $rootScope.id = localStorage['id'];
            console.log($rootScope.id);
            if($rootScope.loggedIn && toState.data.guest) {
                event.preventDefault();
                $state.go('home', {}, {reload: true});
                return false;
            } else if(!toState.data.guest && !$rootScope.loggedIn) {
                event.preventDefault();
                $state.go('login', {}, {reload: true});
                return false;
            }     
    });
}])
