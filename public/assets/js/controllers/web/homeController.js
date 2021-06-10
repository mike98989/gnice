    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('homeController', ['$scope','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;

    $scope.fetch_all_category = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_all_category',
        type: 'GET',
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: false,
        headers:{'gnice-Authenticate':'gnice-web'},
        processData: false,
        success: function (result) {
       //alert(result);
       var response=JSON.stringify(result);
       var parsed = JSON.parse(response);
       var msg=angular.fromJson(parsed);
       $('.loader').hide(); 
       if(msg.status=='1'){  
      
       $scope.categories = msg.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
       
        }
      });
    }
  }]);
