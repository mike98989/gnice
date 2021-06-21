    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('homeController', ['$scope','$filter','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $filter, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    //alert($scope.dirlocation);
    $scope.fetch_all_category = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_all_category',
        type: 'GET',
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result) {
        //alert(result);
       var response=JSON.stringify(result);
       var parsed = JSON.parse(response);
       var msg=angular.fromJson(response);
       $('.loader').hide(); 
       if(msg.status=='1'){  
      
       $scope.categories = msg.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
       
        }
      });
    }

        $scope.fetch_all_sub_category = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_all_sub_category',
        type: 'GET',
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result1) {
        //alert(result1);
       var response1=JSON.stringify(result1);
       var parsed1 = JSON.parse(response1);
       var msg1=angular.fromJson(response1);
       console.log(msg1);
       $('.loader').hide(); 
       if(msg1.status=='1'){  
      
       $scope.subcategories = msg1.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
       
        }
      });
    }

    
  }]);
