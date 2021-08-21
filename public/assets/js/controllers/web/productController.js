    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('productController', ['$scope','$filter','$sce','$http','infogathering','$routeParams','$localStorage','$sessionStorage', function($scope, $filter, $sce, $http, datagrab,$routeParams,$localStorage,$sessionStorage) {
    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30; 
    $scope.user_data  = $localStorage.user_data;
    $scope.user_token  = $localStorage.user_token;
    

    // $('#butn').click(function(event) {
    // event.preventDefault();
    // var up_id = $('#up_courseid').val();
    //    var sub = $('#cat').val();
    //    //alert(sub);
    //    if (sub != '') {
    //      $localStorage.valueToShares = sub;
    //  window.location.assign(
    //                 'CategoryList');
    //    }
       

    //  })

    $('#price_range').slider({
        range:true,
        min:0,
        max:10000,
        values:[0, 10000000],
        step:100,
        stop:function(event, ui)
        {
          $('#price_show').html(ui.values[0] + ' -' + ui.values[1]);
          $('#hidden_minimum_price').val(ui.values[0]);
          $('#hidden_maximum_price').val(ui.values[1]);
          filter_data();
        }
      });
        

  $scope.add_product = function(){
  $('.loader').show();    
    var formData = new FormData($('#add_product')[0]);
    $.ajax({
          url: $scope.dirlocation+'api/add_product',
          type: 'POST',
          headers:{'gnice-authenticate':'gnice-web'}, 
          data: formData,
          async: true,
          cache: false,
          contentType: false,
          enctype: 'multipart/form-data',
          crossDomain: true,
          processData: false,
          success: function (answer) {
          alert(JSON.stringify(answer));
          var response=JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg=angular.fromJson(parsed);
          $('.loader').hide();  
    if(msg.status=='1'){
        $('.loader').hide();    
        $('.result').html(msg.message);  
        $('.result').show();
        alert(msg.message);
        //window.location.assign('Advert');
  }else{
          $('.loader').hide();    
        $('.result').html(msg.message);  
        $('.result').show();
        alert(msg.message);
        }
        
          }
        });
    }


  $scope.update_product = function(){

  $('.loader').show();    
         
          var sub = $('#brand').val();
          //alert($('#sub_category').val());
          //alert(sub);
          var formData = new FormData($('#add_product')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/update_product',
               //type: 'POST',
                type: 'GET',
              method : "post",
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
              window.location.assign(
                    'Advert');
        }else{
               $('.loader').hide();    
              $('.result').html(msg.message);  
              $('.result').show();
              alert(msg.message);
              }
              
               }
             });
    }

        
    $scope.fetch_all_product_of_seller = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_all_product_of_seller?seller_id='+$scope.user_data.seller_id,
        type: 'GET',
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers:{'gnice-authenticate':$scope.user_token}, 
        processData: false,
        success: function (result1) {
        //alert(result1);
       var response1=JSON.stringify(result1);
       var parsed1 = JSON.parse(response1);
       var msg1=angular.fromJson(parsed1);
       $('.loader').hide(); 
       if(msg1.status=='1'){  
       $scope.products = msg1.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.products));
       }
       
        }
      });
    }


        $scope.message_product_seller = function(){
          $('.loader').show();    
          var formData = new FormData($('#message_product_seller')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/message_product_seller',
                type: 'POST',
                headers:{'gnice-authenticate':$scope}, 
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
               crossDomain: true,
               processData: false,
               success: function (answer) {
               //alert(answer);
               var response=JSON.stringify(answer);
               var parsed = JSON.parse(response);
               var msg=angular.fromJson(parsed);
              $('.loader').hide();  
              if(msg.status=='1'){
                $('.loader').hide();    
                $('.result').html(msg.message);  
                $('.result').show();
              }else{
               $('.loader').hide();    
              $('.result').html(msg.message);  
              $('.result').show();
              alert(msg.message);
              }
              
               }
             });
    }

     




              $scope.add_profileDetails = function(){

  $('.loader').show();    
         
      
          //alert($('#category').val());
          //alert(sub);
          var formData = new FormData($('#add_profileDetails')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/add_profileDetails',
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


              $scope.add_profileImg = function(){

  $('.loader').show();    
         
          var sub = $('#sub_category').val();
          //alert($('#category').val());
          //alert(sub);
        
          var formData = new FormData($('#add_profileImg')[0]);
          $.ajax({
                url: $scope.dirlocation+'api/add_profileImg',
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

    $scope.onCategoryValueChange = function(value){
      let objectval = JSON.parse(value);   
      $scope.selected_category = objectval;
      $scope.sub_category = objectval.subcategory;
    }

    $scope.fetch_all_categories_and_sub_categories = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_all_categories_and_sub_categories',
        type: 'GET',
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result) {
        //alert(JSON.stringify(result));
       var response=JSON.stringify(result);
       var parsed = JSON.parse(response);
       var msg=angular.fromJson(parsed);
       
       console.log(msg);
       //alert(msg.data[0].title);
   //alert(msg.data[0].subcategory[6].parent_id);
       $('.loader').hide(); 
       if(msg.status=='1'){  
       $scope.categories_and_sub =msg.data;
    
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
       
        }
      });
    }

    $scope.fetch_all_product = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_all_product',
        type: 'GET',
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result2) {
       
       var response2=JSON.stringify(result2);
       var parsed2 = JSON.parse(response2);
       var msg2=angular.fromJson(parsed2);
       console.log(msg2);
      
       $('.loader').hide(); 
       if(msg2.status=='1'){ 
        
       $scope.products = msg2.data;


       $scope.$apply();
      
       //alert(JSON.stringify($scope.categories));
       }
       
        }
      });
    }

  
    $('body').delegate('.pbtn','click',function(event) {
       event.preventDefault();
       var delid1 = $(this).attr('data-id1');
       var delid2 = $(this).attr('data-id2');
       var delid3 = $(this).attr('data-id3');
       $localStorage.valueToShare1 = delid1;
       $localStorage.valueToShare2 = delid2;
       $localStorage.valueToShare3 = delid3;
       //alert($localStorage.valueToShare2);
      window.location.assign(
                    'Product');
     });
      $('body').delegate('.upbtn','click',function(event) {
       event.preventDefault();
       var delid1 = $(this).attr('data-id1');
       $localStorage.valueToShare1 = delid1;
       
      window.location.assign(
                    'Update');
     });

    $('body').delegate('.cbtn','click',function(event) {
      event.preventDefault();
      var clid = $(this).attr('data-id4');
      var clid2 = $(this).attr('data-id5');
     // alert(clid+' '+clid2);
     $localStorage.valueToShare4 = clid;
     $localStorage.valueToShares = clid2;
     window.location.assign(
                    'Category');
  })
      $('body').delegate('.cabtn','click',function(event) {
      event.preventDefault();
      var clid = $(this).attr('data-idc');
     
      //alert(clid);
     $localStorage.valueToShares = clid;
     window.location.assign(
                    'CategoryList');
  })

     $scope.searchCat = function () {
      var cad = $('#cat').val();
      if (cad == "" ) {
      
     } else {
      var splits = cad.split(",");
      $localStorage.valueToShare4 = splits[0];
      $localStorage.valueToShare5 = splits[1];

       window.location.assign(
                    'Category');
     }
      
     }

     
      $scope.fetch_product_by_term = function(){
      var formData = new FormData($('#fetch_product_by_term')[0]);
      $.ajax({
        url: $scope.dirlocation+'api/fetch_product_by_term',
           type: 'GET',
              method : "post",
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
        success: function (result3) {
        alert(result3);
       var response3=JSON.stringify(result3);
       var parsed3 = JSON.parse(response3);
       var msg3=angular.fromJson(response3);
       console.log(msg3);
       $('.loader').hide(); 
       if(msg3.status=='1'){  
        alert(msg3);
        console.log(msg3.data.image);
       $scope.singleUser = msg3.data;
      
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
        }
      });
    }
  
     $scope.fetch_single_product = function(){
      var url = window.location.href;
      var split_url = url.split('/').pop();
      if(split_url){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_single_product?id='+split_url,
        type: 'GET',
        async: true,
        cache: false,
        contentType: false,
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result3) {
        //alert(result3);
       var response3=JSON.stringify(result3);
       var parsed3 = JSON.parse(response3);
       var msg3=angular.fromJson(parsed3);
       
       $('.loader').hide(); 
       if(msg3.status=='1'){ 
       $scope.product = msg3.data; 
       $scope.product_image = $scope.split_image($scope.product.image);
       $scope.fetch_related_products();
       $scope.$apply();

       }
        }
      });
    }
    }



      $scope.fetch_related_products = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_related_products?sub_cat_id='+ $scope.product.sub_category+'&brand='+ $scope.product.brand+'&product_code='+ $scope.product.product_code,
        type: 'GET',
        cache: false,
        contentType: false,
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result7) {
       var response7=JSON.stringify(result7);
       var parsed7 = JSON.parse(response7);
       var msg7=angular.fromJson(parsed7);
       $('.loader').hide(); 
       if(msg7.status=='1'){  
       $scope.relatedProducts = msg7.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
        }
      });
    }

      $scope.fetch_all_product_brand = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_all_product_brand?id='+ $localStorage.valueToShare4,
        type: 'GET',
       
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
      
        cache: false,
        contentType: false,
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (response8) {
        //alert(response8);
       var responses8=JSON.stringify(response8);
       var parsed8 = JSON.parse(responses8);
       var data8=angular.fromJson(responses8);
       //console.log(data7);
       $('.loader').hide(); 
       if(data8.status=='1'){  
       $scope.allBrands = data8.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
        }
      });
    }
               $scope.fetch_all_product_color = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_all_product_color?id='+ $localStorage.valueToShare4,
        type: 'GET',
       
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
      
        cache: false,
        contentType: false,
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (response9) {
        //alert(response9);
       var responses9=JSON.stringify(response9);
       var parsed9 = JSON.parse(responses9);
       var data9=angular.fromJson(responses9);
       //console.log(data7);
       $('.loader').hide(); 
       if(data9.status=='1'){  
       $scope.allColors = data9.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
        }
      });
    }

         $scope.fetch_selected_sub_category = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_selected_sub_category?id='+ $localStorage.valueToShare5,
        type: 'GET',
       
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
      
        cache: false,
        contentType: false,
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result8) {
        //alert(result8);
       var response8=JSON.stringify(result8);
       var parsed8 = JSON.parse(response8);
       var msg8=angular.fromJson(response8);
       console.log(msg8);
       $('.loader').hide(); 
       if(msg8.status=='1'){  
       $scope.relSubCats = msg8.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
        }
      });
    }

    
            $scope.fetch_single_sub_category = function(){
      $.ajax({
        url: $scope.dirlocation+'api/fetch_single_sub_category?id='+ $localStorage.valueToShare4,
        type: 'GET',
       
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
      
        cache: false,
        contentType: false,
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result8) {
        //alert(result8);
       var response8=JSON.stringify(result8);
       var parsed8 = JSON.parse(response8);
       var msg8=angular.fromJson(response8);
       console.log(msg8);
       $('.loader').hide(); 
       if(msg8.status=='1'){  
       $scope.singleSubCats = msg8.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
        }
      });
    }
    
    
      


     $scope.fetch_selected_product = function(){
       var pid =  $localStorage.valueToShare;
        $.ajax({
        url: $scope.dirlocation+'api/fetch_selected_product',
        type: 'GET',
        method : "post",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        data : $localStorage.valueToShare1,
        async: true,
        cache: false,
        contentType: false,
        headers:{'gnice-authenticate':'gnice-web'}, 
        processData: false,
        success: function (result4) {
        //alert(result4);
       var response4=JSON.stringify(result4);
       var parsed4 = JSON.parse(response4);
       var msg4=angular.fromJson(response4);
       $('.loader').hide(); 
       if(msg4.status=='1'){ 
       $scope.selectedProducts = msg4.data;
       $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       }
        }
      }); 
    }
    

    

          $scope.search = function (item) {
        if ($scope.searchText == undefined) {
          return true;
        } else {
           if (item.name.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1 || item.brand.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1
            || item.color.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1 || item.price.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1 || item.productCategory.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1 || item.productSubCategory.toLowerCase().indexOf($scope.searchText.toLowerCase()) != -1) { 
          return true;
        }
        }
       return false;
      }
    
    $scope.brand = function () {
       $('body').delegate('.brands','click',function(event) {
      event.preventDefault();
       var b = $(this).attr('data-brand');
      $scope.searchBrand = b;
  })
     }
 

        $scope.fetch_required_table = function () {  
          $.ajax({
                url: $scope.dirlocation+'api/fetch_required_table',
               type: 'GET',
               //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
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
               var msg=angular.fromJson(parsed);
              
               if(msg.status=='1'){  
                 console.log(msg.data);
                  $scope.requiredState = msg.data.states;
                  $scope.requiredPhone = msg.data.phone_makes;
                  $scope.requiredCar = msg.data.car_makes;
                  $scope.requiredProperty = msg.data.property_types;
                  $scope.requiredCondition = msg.data.conditions;
          

          $scope.$apply();
       //alert(JSON.stringify($scope.categories));
       } 
      
              
               }
             });

    }


    
  }]);
