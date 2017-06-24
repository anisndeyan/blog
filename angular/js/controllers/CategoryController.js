app.controller('CategoryController', ['$scope','$rootScope','$http','$state','$stateParams', function ($scope, $rootScope, $http, $state,$stateParams) {

	$rootScope.id = localStorage['id'];
	$rootScope.user = localStorage['user'];
    $rootScope.loggedIn = localStorage['loggedIn'];
	$scope.inputs = {};
	var currentState = $state.current.name;

	init();

	function init() {
		switch(currentState) {
			case 'editCategory':
				edit();
				break;
			case 'myCategory':
				show();
				break;
			case 'allCategory':
				index();
				break;
		}
	}

	edit

	function edit() {
		show();
		
	}



    $scope.createCategory = function (inputs) {

    	$scope.inputs = inputs;
    	$scope.inputs.user_id = $rootScope.id;

    	$http.post('/api/createCategory', $scope.inputs)
	    	.then (function (response){
	    		$scope.message = response.data.message;
	    		$state.go('createCategory', $scope.message);
	    	}),
 			function(response){	
        	  $state.go('createCategory');  
        	}; 	
    }

	

    $scope.edit = function(inputs){
        $scope.inputs = inputs;
        $state.go('editCategory',{ id:$scope.inputs});
    }

   


}])
