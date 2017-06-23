app.controller('AuthController', ['$scope', '$http','$rootScope','$state', function($scope, $http, $rootScope, $state) {
	
	$scope.inputs = {};
	$rootScope.user = '';
    $rootScope.loggedIn = false;
    
	$scope.register = function (inputs) {
		$scope.inputs = inputs;
		//console.log($scope.inputs)
		
		$http.post('/api/register', $scope.inputs)

			.then(function(response){

				localStorage.setItem('user',response.data.data.name);
	            $rootScope.user = localStorage['user'];
	            localStorage.setItem('loggedIn',true);
	            $rootScope.loggedIn = localStorage['loggedIn'];
	            $state.go('home');
			});
	}
	$scope.login = function(inputs){
		$scope.inputs = inputs;

		$http.post('/api/login', $scope.inputs)

			.then(function (response){
				console.log(response.data);

                localStorage.setItem('user',response.data.data.name);
				localStorage.setItem('id',response.data.data.id);

                $rootScope.id = localStorage['id'];
                $rootScope.user = localStorage['user'];
             
                localStorage.setItem('loggedIn',true);
                $rootScope.loggedIn = localStorage['loggedIn'];
               
                $state.go('home');
			});
	}

 	$rootScope.user = localStorage['user'];
    $rootScope.id = localStorage['id'];
    $rootScope.loggedIn = localStorage['loggedIn'];

	$scope.logout = function () {
		$http.get('/api/logout')
		.then(function (response) {
				localStorage.clear();
        		$rootScope.loggedIn = false;
        		$state.go('index');
		});
	}
}]);

