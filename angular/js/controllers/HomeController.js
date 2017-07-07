app.controller('HomeController', ['$scope', '$http', '$state', '$rootScope', function($scope, $http, $state, $rootScope) {
	
	$rootScope.id = localStorage['id'];
	$rootScope.user = localStorage['user'];
    $rootScope.loggedIn = localStorage['loggedIn'];

    $http.get('/api/home')
    	.then(function(response){
	    	localStorage.setItem('userCount', response.data.userCount);
	    	$rootScope.userCount = localStorage['userCount'];
	    	localStorage.setItem('categoryCount',response.data.categoryCount);
	    	$rootScope.categoryCount = localStorage['categoryCount'];
	    	localStorage.setItem('postCount',response.data.postCount);
	    	$rootScope.postCount = localStorage['postCount'];
    	})
}]);
