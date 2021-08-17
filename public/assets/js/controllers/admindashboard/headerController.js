    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('headerController', ['$scope','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    
    //$('.loader').show();  
    var url = window.location.href;
    // if(url.indexOf('home')>1){
    //   $scope.menu_active = '1';  
    // }
    // else if((url.indexOf('profile')>1)||(url.indexOf('staff')>1)){
    // $scope.menu_active = '2';  
    // }
    // else if(url.indexOf('meetings')>1){
    //   $scope.menu_active = '3';  
    // }
    // else if(url.indexOf('daily_state')>1){
    //   $scope.menu_active = '4';  
    // }
    // else if(url.indexOf('admins')>1){
    //   $scope.menu_active = '5';  
    // }
    // else if(url.indexOf('qualification')>1){
    //   $scope.menu_active = '6';  
    // }
    // else if(url.indexOf('complaints')>1){
    //   $scope.menu_active = '7';  
    // }
    
    // else{
    //   $scope.menu_active = '1';  
    // }
    
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    $scope.user_data  = datagrab.user_data;
    $scope.user_token  = datagrab.user_token;
    
    

    }]);
