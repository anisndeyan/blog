app.controller('CategoryController', ['$scope','$rootscope', function ($scope, $rootscope) {

	$rootScope.id = localStorage['id'];
	$rootScope.user = localStorage['user'];
    $rootScope.loggedIn = localStorage['loggedIn'];

    $scope.createCategory = function (inputs){
    	console.log(inputs);
    }
}])
