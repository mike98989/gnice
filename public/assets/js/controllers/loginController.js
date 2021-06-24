    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('loginController', ['$scope','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.fieldcounter = 1;
    //$('.loader').show();  
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;


      $scope.password_recovery = function(){

  $('.loader').show();    
         $('.result').hide(); 
          var email = $('#email').val();
          var formData = new FormData($('#password_recovery')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/password_recovery',
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
                $('.loader').hide();  
          if(msg.status=='1'){
         $localStorage.recovery_token= msg.token; 
        //alert(JSON.stringify($localStorage.recovery_token));
        window.location.href=datagrab.completeUrlLocation+'ConfirmRecovery'
        }else{
              $('.loader').hide();    
              $('.result').html(msg.msg);  
              $('.result').show();
               alert(msg.msg);
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
              }
              
               }
             });
    }

      $scope.confirm_password_recovery_code = function(){

  $('.loader').show();    
         $('.result').hide(); 
          var formData = new FormData($('#confirm_password_recovery_code')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/confirm_password_recovery_code',
               type: 'POST',
               //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
               data: formData,
               async: true,
               cache: false,
               contentType: false,
               enctype: 'multipart/form-data',
               headers:{'gnice-authenticate':$localStorage.recovery_token},
               crossDomain: true,
               processData: false,
               success: function (answer) {
               //alert(answer);
               var response=JSON.stringify(answer);
               var parsed = JSON.parse(response);
               var msg=angular.fromJson(response);
                $('.loader').hide();  
              if(msg.status=='1'){
              window.location.href=datagrab.completeUrlLocation+'Login'
             }else{
              $('.loader').hide();    
              $('.result').html(msg.msg);  
              $('.result').show();
               alert(msg.msg);
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
              }
               }
             });
    }




      $scope.user_login = function(){
  $('.loader').show();    
         $('.result').hide(); 
          var username = $('#username').val();
          var password = $('#password').val();
          var formData = new FormData($('#user_login')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/user_login',
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
               alert(msg);
                $('.loader').hide();  
          if(msg.status=='1'){
            alert(msg.data.fullname);
            alert(msg.token);
          $localStorage['user_data']=msg.data;
         $localStorage.user_token=msg.token; 
        //alert(JSON.stringify($localStorage['user_data']));
            window.location.href=datagrab.completeUrlLocation+'Home';
        }else{
              $('.loader').hide();    
              $('.result').html(msg.msg);  
              $('.result').show();
               alert(msg.msg);
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
