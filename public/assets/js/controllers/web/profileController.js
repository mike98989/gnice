    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('profileController', ['$scope','$filter','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $filter, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30; 
    $scope.user_data  = $localStorage.user_data;
    $scope.user_token  = $localStorage.user_token;
     
    $scope.update_profile = function(){
    $('.loader').show();    
    var formData = new FormData($('#update_profile')[0]);
    $.ajax({
            url: $scope.dirlocation+'api/update_user_profile',
            type: 'POST',
            headers:{'gnice-authenticate':$scope.user_token}, 
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            crossDomain: true,
            processData: false,
            success: function (answer) {
            alert(answer);
            var response=JSON.stringify(answer);
            var parsed = JSON.parse(response);
            var msg=angular.fromJson(parsed);
            $('.loader').hide();  
            if(msg.status=='1'){
            $('.loader').hide();    
            $('.result').html(msg.msg);  
            $('.result').show();
            $localStorage["user_data"] = msg.data;
            $scope.user_data  = $localStorage.user_data;
            alert(msg.msg);
            
            }else{
            $('.loader').hide();    
            $('.result').html(msg.message);  
            $('.result').show();
            alert(msg.message);
            }
        
            }
            });
    }
      

    $scope.update_password = function(){
        $('.loader').show();    
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        if(password===confirm_password){
            var formData = new FormData($('#update_password')[0]);
            $.ajax({
                    url: $scope.dirlocation+'api/change_password',
                    type: 'POST',
                    headers:{'gnice-authenticate':$scope.user_token}, 
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    crossDomain: true,
                    processData: false,
                    success: function (answer) {
                    alert(answer);
                    var response=JSON.stringify(answer);
                    var parsed = JSON.parse(response);
                    var msg=angular.fromJson(parsed);
                    $('.loader').hide();  
                    if(msg.status=='1'){
                    $('.loader').hide();    
                    $('.result').html(msg.msg);  
                    $('.result').show();
                    $localStorage["user_data"] = msg.data;
                    $scope.user_data  = $localStorage.user_data;
                    alert(msg.msg);
                    
                    }else{
                    $('.loader').hide();    
                    $('.result').html(msg.message);  
                    $('.result').show();
                    alert(msg.message);
                    }
                
                    }
                    });
                }else{
                var msg = "Passwords do not match";    
                alert(msg);
                $('.loader').hide(); 
                $('.result').html(msg);  
                $('.result').show();
                return;   
                }

        }

  }]);
