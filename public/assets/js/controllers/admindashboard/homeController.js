    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('homeController', ['$scope','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.fieldcounter = 1;
    //$('.loader').show(); 
     
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    
    
    }]);
