    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('homeController', ['$scope','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.fieldcounter = 1;
    //$('.loader').show(); 
     
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    


      $scope.AddBanner = function(){
  $('.loader').show();    
         $('.result').hide(); 
          var formData = new FormData($('#AddBanner')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/AddBanner',
               type: 'POST',
               //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
               data: formData,
               async: true,
               cache: false,
               contentType: false,
               enctype: 'multipart/form-data',
               headers:{'gnice-authenticate':'gnice-web'},
               crossDomain: true,
               processData: false,
               success: function (answer) {
               //alert(answer);
               var response=JSON.stringify(answer);
               var parsed = JSON.parse(response);
               var msg=angular.fromJson(response);
               //alert(msg);
               console.log(msg);
                $('.loader').hide();  
          if(msg.status=='1'){
           $('.loader').hide();    
              $('.result').html(msg.message);  
              $('.result').show();
               alert(msg.message); 
        }else{
              $('.loader').hide();    
              $('.result').html(msg.message); 
              alert(msg.message); 
              $('.result').show();
               
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
              }
              
               }
             });
    }

          $scope.AddBanner = function(){
  $('.loader').show();    
         $('.result').hide(); 
          var formData = new FormData($('#AddBanner')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/AddBanner',
               type: 'POST',
               //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
               data: formData,
               async: true,
               cache: false,
               contentType: false,
               enctype: 'multipart/form-data',
               headers:{'gnice-authenticate':'gnice-web'},
               crossDomain: true,
               processData: false,
               success: function (answer) {
               //alert(answer);
               var response=JSON.stringify(answer);
               var parsed = JSON.parse(response);
               var msg=angular.fromJson(response);
               //alert(msg);
               console.log(msg);
                $('.loader').hide();  
          if(msg.status=='1'){
           $('.loader').hide();    
              $('.result').html(msg.message);  
              $('.result').show();
               alert(msg.message); 
        }else{
              $('.loader').hide();    
              $('.result').html(msg.message); 
              alert(msg.message); 
              $('.result').show();
               
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
              }
              
               }
             });
    }

    


              $scope.AddHero = function(){
  $('.loader').show();    
          var formData = new FormData($('#AddHero')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/AddHero',
               type: 'POST',
             transformRequest: angular.identity,
               //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
               headers:{'gnice-authenticate':'gnice-web'}, 
               data: formData,
               async: true,
               cache: false,
               contentType: false,
                transformRequest: angular.identity,
               enctype: 'multipart/form-data',
              
               crossDomain: true,
               processData: false,
               success: function (answer) {
               alert(answer);
               var response=JSON.stringify(answer);
               var parsed = JSON.parse(response);
               var msg=angular.fromJson(response);
                $('.loader').hide();  
          if(msg.status=='1'){
             $('.loader').hide();    
              $('.result').html(msg.message);  
              $('.result').show();
              alert(msg.message);
        }else{
               $('.loader').hide();    
              $('.result').html(msg.message);  
              $('.result').show();
              alert(msg.message);
              }
              
               }
             });
    }

    
    
    }]);
