app.controller('HomeController', ['$scope', '$http','$rootScope','$state', function($scope, $http, $rootScope, $state) {
	$rootScope.user = localStorage['user'];
    $rootScope.id = localStorage['id'];
    $rootScope.loggedIn = localStorage['loggedIn'];
	console.log( $rootScope.id);
}]);
