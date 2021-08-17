    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('usersController', ['$scope','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.fieldcounter = 1;
    //$('.loader').show(); 
    var url = window.location.href;
    if(url.indexOf('#')>1){
      var page = window.location.href.split('#');
      var pager = page[1].split('=').pop();
      
    if((pager=='')||(pager=='undefined')||(pager==null)||(pager=='0')){
        pager='1';
      }
    }else{
      pager='1';
    }

    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = pager;
    $scope.pageSize = 3;
    $scope.admin_data  = $localStorage.user_data;
    $scope.admin_token  = $localStorage.user_token;
    setTimeout(function(){ 
    $scope.$apply();
    }, 0);
   
    $scope.get_all_users = function(){
      
        $('.loader').show();  
        $('.result').hide();  
        //alert(JSON.stringify($scope.admin_data.email));
        $.ajax({
             url: $scope.dirlocation+'admindashboard/get_all_users',
             type: 'GET',
             async: true,
             cache: false,
             contentType: false,
             headers:{'gnice-authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
             processData: false,
             success: function (result) {
            //alert(JSON.stringify(result));
            var response=JSON.stringify(result);
            var parsed = JSON.parse(response);
            var msg=angular.fromJson(parsed);
            $('.loader').hide();
            //alert(JSON.stringify(msg.data)); 
            if(msg.status=='1'){    
            $scope.all_users = msg.data;
            $scope.$apply();
            $('.result').show();
            }else{   
            $('.result').html(msg.message);  
            $('.result').show();
            }
            
             }
           });

    }

    
    //$scope.$apply();
    //alert(JSON.stringify(datagrab.user_token));
    if($routeParams.next){
      $scope.page=$routeParams.next*1;
    }else{
      $scope.page=1;
      //$scope.$apply();
    }

    //alert($scope.page+'asasdfsd');

    $scope.query_staff_record = function(){
      //$scope.all_staff='';

      var formData = new FormData($('#staff_query_form')[0]);
        $('.loader_search').show();  
        $('.table-result').hide();  
        //alert(JSON.stringify($scope.admin_data.email));
        $.ajax({
             url: $scope.dirlocation+'api/query_staff_record?token='+$scope.admin_token,
             data:formData,
             type: 'POST',
             async: true,
             cache: false,
             contentType: false,
             headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
             processData: false,
             success: function (result) {
            //alert(result);
            var response=JSON.stringify(result);
            var parsed = JSON.parse(response);
            var msg=angular.fromJson(parsed);
            $('.loader_search').hide(); 
            if(msg.status=='1'){    
            $scope.all_staff = msg.data;
            $scope.$apply();
            $('.table-result').show();
            $('#staff_query_form').hide('slow');
            $('.show_form_btn').show();
            //alert(JSON.stringify(msg));
            }else{   
            $('.result').html(msg.message);  
            $('.result').show();
            //$('.signup_loader').hide();
            //$('.alert').html(answer);
            }
            
             }
           });
    }

    $scope.get_staff_qualifications = function(serviceNo){
      $('.loader').show();    
      $('.result').hide();
      $.ajax({
           url: $scope.dirlocation+'api/get_staff_qualifications?serviceNo='+serviceNo,
           type: 'GET',
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
           processData: false,
           success: function (result) {
             $('.loader').hide();    
             ///alert(JSON.stringify(result));
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
             $scope.qualifications = angular.fromJson(msg.data);
             //alert($scope.states);
            $scope.$apply();
          
           }
         });
    }

    $scope.activate_or_deactivate = function(status,staff,index){
    $('.loader1_'+staff.serviceNo).show();    
      $.ajax({
           url: $scope.dirlocation+'api/activate_or_deactivate?status='+status+'&serviceNo='+staff.serviceNo+'&route=staff',
           type: 'POST',
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
           processData: false,
           success: function (result) {
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
              $('.loader1_'+staff.serviceNo).hide();  
              if(msg.status=='1'){
                demo.showNotification(msg.msg);
               $scope.all_staff[index].status = status;
               $scope.$apply();
              }
          
           }
         });   

    }

    
    $scope.verify_staff_record = function(staff){
      
    $('.loader').show();    
      $.ajax({
           url: $scope.dirlocation+'api/verify_staff_record?serviceNo='+staff.serviceNo+'&route=staff',
           type: 'POST',
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
           processData: false,
           success: function (result) {
            //alert(result);
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
              $('.loader').hide();  
              if(msg.status=='1'){
                demo.showNotification(msg.msg);
               staff.verified = '1';
               $scope.$apply();
              }
          
           }
         });   

    }

    $scope.delete_staff_record = function(staff,index){
    var conf = confirm("DO YOU WANT TO DELETE "+staff.fname+" "+staff.sname+"'s ACCOUNT?");
    if(conf){   
    if($scope.admin_data.account_type!='5'){
    alert("SORRY YOU DO NOT HAVE PERMISSION TO DELETE THIS ACCOUNT");
    return;
    }else{
    $('.loader2_'+staff.serviceNo).show();    
      $.ajax({
           url: $scope.dirlocation+'api/delete_staff_record?serviceNo='+staff.serviceNo,
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
           processData: false,
           success: function (result) {
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
              $('.loader2_'+staff.serviceNo).hide();  
              //alert(msg.msg);
              demo.showNotification(msg.msg);
             
              if(msg.status=='1'){
               $scope.all_staff.splice(index,1);
                //window.location.reload();
               $scope.$apply();

              }
          
           }
         });   
    }
  }

    }


    $scope.restore_staff_record = function(staff,index){
    var conf = confirm("DO YOU WANT TO RESTORE "+staff.fname+" "+staff.sname+"'s ACCOUNT?");
    if(conf){   
    if($scope.admin_data.account_type!='5'){
    alert("SORRY YOU DO NOT HAVE PERMISSION TO DELETE THIS ACCOUNT");
    return;
    }else{
    $('.loader2_'+staff.serviceNo).show();    
      $.ajax({
           url: $scope.dirlocation+'api/restore_staff_record?serviceNo='+staff.serviceNo,
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
           processData: false,
           success: function (result) {
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
              $('.loader2_'+staff.serviceNo).hide();  
              //alert(msg.msg);
              demo.showNotification(msg.msg);
              if(msg.status=='1'){
               $scope.all_staff.splice(index,1);
               //window.location.reload();
               $scope.$apply();
              }
          
           }
         });   
    }
  }

    }
    

    $scope.update_staff_data = function(){
      $('.loader').show();    
      $('.result').hide();
      var formData = new FormData($('#update_staff_data')[0]);
      $.ajax({
           url: $scope.dirlocation+'api/update_staff_data_from_admin',
           data:formData,
           type: 'POST',
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
           processData: false,
           success: function (result) {
             //alert(result);
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
              $('.loader').hide();  
              if(msg.status=='1'){
                //alert(msg.token)
              //alert(msg.msg);
              //$localStorage['user_data']=msg.data;
              demo.showNotification(msg.msg);
              $scope.localStorage_save('staff_data',msg.data,'');
              //alert(JSON.stringify(msg.data));
              document.body.scrollTop = 0; // For Safari
              document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
              $('.result').html(msg.msg);  
              $('.result').show();
              var next = ($scope.page*1)+1; 
              if(next<4){
              setTimeout(function(){ 
              //var next = ($scope.page*1)+1;  
              window.location.href=datagrab.completeUrlLocation+'admindashboard/edit_profile?next='+next;
              }, 2000);
              }else{
              setTimeout(function(){ 
              //var next = ($scope.page*1)+1;  
              window.location.href=datagrab.completeUrlLocation+'admindashboard/staff';
              }, 2000);  
              }
              $('.result').html(msg.message);  
              $('.result').show();
              }else{
                  
              $('.result').html(msg.message);  
              $('.result').show();
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
              }
          
           }
         });
    }

    $scope.new_staff_data = function(){
      $('.loader').show();    
      $('.result').hide();
      var formData = new FormData($('#new_staff_data')[0]);
      $.ajax({
           url: $scope.dirlocation+'api/new_staff_data',
           data:formData,
           type: 'POST',
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
           processData: false,
           success: function (result) {
             //alert(result);
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
              $('.loader').hide();  
              if(msg.status=='1'){
              $('#new_staff_data').hide();  
              $('.result').html(msg.msg);  
              $('.result').show();
              }else{
              $('.result').html(msg.msg);  
              $('.result').show();
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
              }
          
           }
         });
    }


      $scope.upload_staff_data = function(){
        
      $('.loader').show();    
      $('.result').hide();
      $('#sample_uploaded_data').hide();
      var formData = new FormData($('#upload_staff_data')[0]);
      $.ajax({
           url: $scope.dirlocation+'api/upload_staff_data',
           data:formData,
           type: 'POST',
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token+':email:'+$scope.admin_data.email},
           processData: false,
           success: function (result) {
              //alert(result);
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
              //var datavalue = JSON.parse(msg.data);
              
               //alert(JSON.stringify(msg.data));return;
              $('.loader').hide();  
              if(msg.status=='100'){
              $scope.sample_enabled = true;
              $scope.sample_uploaded_data = msg.data;
              //$('#upload_staff_data').hide(); 
              $('#sample').hide(); 
              $('#sample_uploaded_data').show();  
              //$('.result').html(msg.msg);  
              //$('.result').show();
               $scope.$apply();
              }
              else if(msg.status=='1'){
               //alert('asdfasdf');
              $('.result').html(msg.msg);  
              $('.result').show();
              //$('#sample_uploaded_data').show(); 
                //alert(msg.msg);
              }
              else{
              $('.result').html(msg.msg);  
              $('.result').show();
              //$('.signup_loader').hide();
              //$('.alert').html(answer);
              }
          
           }
         });
    }

    $scope.get_related_tables = function(){
      $('.loader').show();    
      $('.result').hide();
     
      $.ajax({
           url: $scope.dirlocation+'api/get_related_tables',
           type: 'GET',
           async: true,
           cache: false,
           contentType: false,
           headers:{'Rhims-Authenticate':$scope.admin_token},
           processData: false,
           success: function (result) {
             //alert(JSON.stringify(result));
              var response=JSON.stringify(result);
              var parsed = JSON.parse(response);
              var msg=angular.fromJson(parsed);
             $scope.lgas = angular.fromJson(msg.lgas);
             $scope.states = angular.fromJson(msg.states);
             $scope.ranks = angular.fromJson(msg.ranks);
             //alert($scope.states);
            $scope.$apply();
          
           }
         });
    }

    $scope.localStorage_get = function(key){
        $scope[key] = $localStorage[key];
        $scope.$apply();
    }

    $scope.localStorage_save = function(key,value,url){
        $localStorage[key] = value;
        //$scope[key] = $localStorage[key];
        //alert(JSON.stringify(value));
        if(url!=''){
            $scope.go_to_url(url);
        }
    }

    $scope.go_to_url = function (url){
        //alert($scope.dirlocation+'admindashboard/'+url);
        window.location.href=$scope.dirlocation+'admindashboard/'+url;
    }

    $scope.generate_id_card = function(staff_data){
        //var qrcode = new QRCode("qrcode");
        var qrcode = new QRCode("qrcode", {
            text: "http://rims.corrections.gov.ng",
            width: 130,
            height: 130,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        qrcode.makeCode('Name:'+staff_data.sname+' '+staff_data.fname+' '+staff_data.othernames+' | ServiceNo:'+staff_data.serviceNo+' | Rank:'+staff_data.presentRank+' | BG:'+staff_data.blood_group+' | Img:'+staff_data.photo+' | Url: https://rims.corrections.gov.ng/staff?identity='+staff_data.serviceNo);
        $('.id_card_template').show();
        $('.id_card_template_back').show();
        $('.generate_id').hide();
        
        
    }


    $scope.bind_blood_group = function(blood_group){
      var count = (blood_group.match(/und/g) || []).length;
      if(blood_group==''){
        bg = 'A';
      }else if(count>0){
        bg = "A";
      }
      else{
        bg = blood_group;
      }
      return bg;
    }

    $scope.bind_command = function(command){
      var count = (command.match(/und/g) || []).length;
      if(command==''){
        cmd = '1';
      }else if(count>0){
        cmd = "1";
      }
      else{
        cmd = command;
      }
      return cmd;
    }


    $scope.bind_rank = function(rank){
      var count = (rank.match(/und/g) || []).length;
      if(rank==''){
        rnk = '';
      }else if(count>0){
        rnk = "";
      }
      else{
        rnk = rank;
      }
      return rnk;
    }

    

     $scope.bind_deformity = function(deformity){
      var count = (deformity.match(/und/g) || []).length;
      //alert(count)
      if(deformity==''){
        df = 'no';
      }else if(count>0){
        df = "no";
      }
      else{
        df = deformity;
      }
      return df;
    }

     $scope.bind_marital_status = function(status){

      var count = (status.match(/und/g) || []).length;
      if(status==''){
        stat = 'Single';
      }else if(count>0){
        stat = "Single";
      }
      else{
        stat = status;
      }
      
      return stat;
    }

    $scope.bind_previous_conviction = function(conviction){
      //alert(conviction);
      var count = (conviction.match(/und/g) || []).length;
      //alert(count)
      if(conviction==''){
        conv = 'no';
      }else if(count>0){
        conv = "no";
      }
      else{
        conv = conviction;
      }
      return conv;
    }


    }]);
