app.controller('CategoriesController', ['$scope','$rootScope','$http','$state','$stateParams', 'data', function ($scope, $rootScope, $http, $state,$stateParams, data) {

	$rootScope.id = localStorage['id'];
	$rootScope.user = localStorage['user'];
    $rootScope.loggedIn = localStorage['loggedIn'];
	$scope.inputs = {};

    var currentState = $state.current.name;
	init();

	function init() {
		switch(currentState) {
            case 'myCategories': index(); break;
            case 'allCategories': show(); break;
            case 'editCategory': edit(); break;
			case 'categoryPost': posts(); break;
		}
	}
	function index () {
        $scope.categories = data.data.categories;
	}
    function show() {
        $scope.categories = data.data.categories;  
    }
    function edit() {
        var id = $stateParams.id;
        $http.get('/api/category/' +id+ '/edit')
            .then(function(response){
                $scope.category = response.data.category;
            }); 
    }
    function posts(){
        var id = $state.params.id;
        $http.get('/api/category/' +id+ '/post')
            .then(function(response){
                $scope.posts = response.data.posts;
            });
    }

    $scope.createCategory = function (inputs) {
    	$scope.inputs = inputs;
    	$scope.inputs.user_id = $rootScope.id;
    	$http.post('/api/category/create', $scope.inputs)
	    	.then (function (response){
	    	    $scope.message = response.data.message;
	    		$state.go('createCategory', $scope.message);
	    	})
    }
    $scope.edit = function(inputs){
        $scope.inputs = inputs;
        $state.go('editCategory',{ id:$scope.inputs});
    }
    $scope.update = function(inputs){
        $scope.inputs = inputs;
        $http.put('/api/category/'+ $scope.inputs.id + '/update', $scope.inputs)
            .then(function(response){
                $scope.message = response.data.message;
            }); 
    }
    $scope.delete = function(inputs){
        $scope.inputs = inputs;
        $http.delete('/api/category/' + $scope.inputs)
        	.then(function(response){
            $scope.message = response.data.message;
        }); 
        
    }    

}])
