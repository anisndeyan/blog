app.controller('PostsController', ['$scope', '$http', '$stateParams', '$rootScope','$state','data','Upload', function($scope, $http, $stateParams, $rootScope, $state, data, Upload) { 
	
	$rootScope.user = localStorage['user'];
    $rootScope.id = localStorage['id'];
    $rootScope.loggedIn = localStorage['loggedIn'];

    var currentState = $state.current.name;
    init();

    function init() {
        switch(currentState) {
            case 'myPosts': index(); break;
            case 'allPosts': show(); break;
            case 'editPost': edit(); break;
        }
    }
    function index () {
        $scope.posts = data.data.posts;
    }
    function show() {
        $scope.posts = data.data.posts;  
        $scope.user = $rootScope.id;
    }
    function edit() {
        var id = $stateParams.id;
        $http.get('/api/post/' +id+ '/edit')
            .then(function(response){
                $scope.post = response.data.posts;
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
            file.upload.then(function (response) {
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
                $scope.message = response.data.message;
            });  
    }
}]);
