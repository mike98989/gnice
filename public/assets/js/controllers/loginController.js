    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('loginController', ['$scope','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.fieldcounter = 1;
    //$('.loader').show();  
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;

    $scope.user_login = function(){
    $('.loader').show();    
    $('.result').hide();

    var serviceNo = $('#serviceno').val();
    var pwrd = $('#password').val();
    var formData = new FormData($('#user_login')[0]);
    var redirectTo = $('#redirectTo').val();
    //alert(redirectTo);return;
    $.ajax({
         url: $scope.dirlocation+'api/user_login',
         type: 'POST',
         //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
         data: formData,
         async: true,
         cache: false,
         contentType: false,
         enctype: 'multipart/form-data',
         headers:{'Rhims-Authenticate':serviceNo+':pwrd:'+pwrd},
         crossDomain: true,
         processData: false,
         success: function (answer) {
         //alert(answer);
         var response=JSON.stringify(answer);
         var parsed = JSON.parse(response);
         var msg=angular.fromJson(parsed);
         $('.loader').hide();  
        if(msg.status=='1'){
        $localStorage['user_data']=msg.data;
        $localStorage['user_token']=msg.token; 
        //alert(JSON.stringify($localStorage['user_data']));

        if(redirectTo==''){ 
        window.location.href=datagrab.completeUrlLocation+'dashboard';
        }else{
        //alert(redirectTo);return;  
        window.location.href=datagrab.completeUrlLocation+redirectTo;  
        }
        }else{
        $('.loader').hide();    
        $('.result').html(msg.message);  
        $('.result').show();
        //$('.signup_loader').hide();
        //$('.alert').html(answer);
        }
        
         }
       });
    }

    $scope.clear_storage = function(){
      $localStorage['fullname_checked']=false;
      window.location.reload();
    }
        $scope.admin_login = function(){
          $('.loader').show();    
          $('.result').hide();
          var username = $('#username').val();
          var pwrd = $('#password').val();
          var formData = new FormData($('#admin_login')[0]);
          
          $.ajax({
               url: $scope.dirlocation+'api/rims_admin_login',
               type: 'POST',
               //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
               data: formData,
               async: true,
               cache: false,
               contentType: false,
               enctype: 'multipart/form-data',
               headers:{'Rhims-Authenticate':username+':pwrd:'+pwrd},
               crossDomain: true,
               processData: false,
               success: function (answer) {
               //alert(answer);
               var response=JSON.stringify(answer);
               var parsed = JSON.parse(response);
               var msg=angular.fromJson(parsed);
               $('.loader').hide();  
              if(msg.status=='1'){
                //alert(msg.token)
              $localStorage['user_data']=msg.data;
              $localStorage['user_token']=msg.token;   
              window.location.href=datagrab.completeUrlLocation+'admindashboard'
              }else{
              $('.loader').hide();    
              $('.result').html(msg.message);  
              $('.result').show();
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
              }
              
               }
             });
          }
    }]);
