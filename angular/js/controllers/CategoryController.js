app.controller('CategoryController', ['$scope','$rootScope','$http','$state','$stateParams', function ($scope, $rootScope, $http, $state,$stateParams) {

	$rootScope.id = localStorage['id'];
	$rootScope.user = localStorage['user'];
    $rootScope.loggedIn = localStorage['loggedIn'];
	$scope.inputs = {};

	var currentState = $state.current.name;

	// init();

	// function init() {
	// 	switch(currentState) {
	// 		case 'editCategory':
	// 			edit();
	// 			break;
	// 		case 'myCategory':
	// 			show();
	// 			break;
	// 		case 'allCategory':
	// 			index();
	// 			break;
	// 	}
	// }



	// function edit() {
	// 	show();
		
	// }
    $scope.createCategory = function (inputs) {

    	$scope.inputs = inputs;
    	$scope.inputs.user_id = $rootScope.id;

    	$http.post('/api/category/create', $scope.inputs)
	    	.then (function (response){
	    		$scope.message = response.data.message;
	    		$state.go('createCategory', $scope.message);
	    	}),
 			function(response){	
        	  $state.go('createCategory');  
        	}; 	
    };

    if(currentState == "myCategory") {
    	$http.get('/api/index')
    		.then(
    			function(response) {
    			$scope.categories = response.data.categories;
    		})
    } else if(currentState == 'allCategory') {  
        $http.get('/api/category/all')
        	.then(function(response){
                $scope.categories = response.data.categories;
            });
    }


    $scope.edit = function(inputs){
        $scope.inputs = inputs;
        $state.go('editCategory',{ id:$scope.inputs});
    }

	if (currentState == 'editCategory') {
		var id = $stateParams.id;
	    $http.get('/api/category/' +id+ '/edit')
	    	.then(function(response){
	            $scope.category = response.data.category;
	        });
	} else if (currentState == 'categoryPost') {
        var id = $state.params.id;
        $http.get('/api/category/' +id+ '/post')
            .then(function(response){

                $scope.posts = response.data.posts;
                console.log($scope.posts);
            });
    }

    $scope.update = function(inputs){
        $scope.inputs = inputs;
        console.log(inputs);
        $http.put('/api/category/'+ $scope.inputs.id + '/update', $scope.inputs)
        	.then(function(response){
            	$scope.message = response.data.message;
       		}); 
    }

    $scope.delete = function(inputs){

        $scope.inputs = inputs;
        $http.delete('/api/category/' + $scope.inputs)
        	.then(function(response){
            document.getElementById($scope.inputs).remove();
            $scope.message = response.data.message;
        }); 
        
    }    

}])
