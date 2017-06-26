app.controller('PostController', ['$scope', '$http', '$stateParams', '$rootScope','$state', 'Upload', function($scope, $http, $stateParams, $rootScope, $state, Upload) { 
	
	$rootScope.user = localStorage['user'];
    $rootScope.id = localStorage['id'];
    $rootScope.loggedIn = localStorage['loggedIn'];

	var currentState = $state.current.name;

    if(currentState == 'createPost') {
        $http.get('/api/index')
        	.then(function(response){
        		$scope.categories = response.data.categories;
        	});
    }

    $scope.createPost = function (inputs, file) {
        $scope.inputs = inputs;

        if(file != undefined) {
         	$scope.inputs.image = file;
          	file.upload = Upload.upload({
                url: '/api/post/create',
                data: $scope.inputs,
            });
            file.upload.then(function (response){
                $scope.message = response.data.message;
            });
        } else {
          	$http.post('/api/post/create',$scope.inputs)
	          	.then(function(response){
	           		$scope.message = response.data.message;
	          	}); 
        }
    }

    if (currentState == 'myPost') {
        $http.get('/api/post/index')
	        .then(function(response){
	           $scope.posts = response.data.posts;
	        });
    } else if (currentState == 'allPost') {
        $http.get('/api/post/all')
	        .then(function(response){
	           $scope.posts = response.data.posts;
	           $scope.user = $rootScope.id;
	        });
    } else if (currentState === 'editPost') {
        var id = $stateParams.id;
        $http.get('/api/post/' +id+ '/edit')
	        .then(function(response){
                //console.log(response.data);
	            $scope.post = response.data.posts;
                $scope.categories = response.data.categories;
	        });
    }

    $scope.edit = function(inputs){
        $scope.inputs = inputs;
        $scope.inputs.user_id = $rootScope.id;
        $state.go('editPost', {id:$scope.inputs});
    }

    $scope.update = function(inputs, file){
      $scope.inputs = inputs;
      if(file != undefined) {

        $scope.inputs.image = file;
        file.upload = Upload.upload({
          url: '/api/post/' +$scope.inputs.id+ '/update',
          data: $scope.inputs,
        });
        file.upload.then(function (response) 
        {
          $scope.message = response.data.message;
        });
      } else {
        $http.post('/api/post/' +$scope.inputs.id+ '/update', $scope.inputs)
            .then(function(response){
              $scope.message = response.data.message;
            },
            function(response){
              $scope.message = response.data.message;
            }); 
      }
    }

    $scope.delete = function(inputs){
        $scope.inputs = inputs;
        $http.delete('/api/post/' + $scope.inputs)
            .then(function(response){
                document.getElementById($scope.inputs).remove();
                $scope.message = response.data.message;
            });  
    }
}]);
