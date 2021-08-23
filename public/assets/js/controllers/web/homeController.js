///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("homeController", [
  "$scope",
  "$filter",
  "$sce",
  "$http",
  "infogathering",
  "$routeParams",
  "$localStorage",
  "$sessionStorage",
  function (
    $scope,
    $filter,
    $sce,
    $http,
    datagrab,
    $routeParams,
    $localStorage,
    $sessionStorage
  ) {
    $scope.dirlocation = datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    $scope.user_data = $localStorage.user_data;
    $scope.user_token = $localStorage.user_token;

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

    $scope.split_image = function (images) {
      return images.split(",");
    };

    $scope.add_product = function () {
      $(".loader").show();
      var sub = $("#brand").val();
      //alert($('#category').val());
      //alert(sub);
      var formData = new FormData($("#add_product")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/add_product",
        //type: 'POST',
        type: "GET",
        method: "post",
        transformRequest: angular.identity,
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        headers: { "gnice-authenticate": "gnice-web" },
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        transformRequest: angular.identity,
        enctype: "multipart/form-data",

        crossDomain: true,
        processData: false,
        success: function (answer) {
          alert(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);
          $(".loader").hide();
          if (msg.status == "1") {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
            window.location.assign("Advert");
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
          }
        },
      });
    };

    $scope.update_product = function () {
      $(".loader").show();
      var sub = $("#brand").val();
      var formData = new FormData($("#add_product")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/update_product",
        //type: 'POST',
        type: "GET",
        method: "post",
        transformRequest: angular.identity,
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        headers: { "gnice-authenticate": "gnice-web" },
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        transformRequest: angular.identity,
        enctype: "multipart/form-data",

        crossDomain: true,
        processData: false,
        success: function (answer) {
          alert(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);
          $(".loader").hide();
          if (msg.status == "1") {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
            window.location.assign("Advert");
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
          }
        },
      });
    };

    $scope.message_product_seller = function () {
      $(".loader").show();
      var formData = new FormData($("#message_product_seller")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/message_product_seller",
        type: "POST",
        headers: { "gnice-authenticate": "gnice-web" },
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        enctype: "multipart/form-data",
        crossDomain: true,
        processData: false,
        success: function (answer) {
          //alert(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          if (msg.status == "1") {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            alert(msg.message);
          }
        },
      });
    };

    $scope.fetch_all_categories_and_sub_categories = function () {
      $.ajax({
        url: $scope.dirlocation + "api/fetch_all_categories_and_sub_categories",
        type: "GET",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (result) {
          //alert(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);

          console.log(msg);

          $(".loader").hide();
          if (msg.status == "1") {
            $scope.catSubs = msg.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    //alert($scope.dirlocation);
    $scope.fetch_all_category = function () {
      $.ajax({
        url: $scope.dirlocation + "api/fetch_all_category",
        type: "GET",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (result) {
          //alert(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);
          $(".loader").hide();
          if (msg.status == "1") {
            $scope.categories = msg.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.fetch_all_subcategory = function () {
      $.ajax({
        url: $scope.dirlocation + "api/fetch_all_subcategory",
        type: "GET",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (result1) {
          //alert(result1);
          var response1 = JSON.stringify(result1);
          var parsed1 = JSON.parse(response1);
          var msg1 = angular.fromJson(response1);

          console.log(msg1);
          $(".loader").hide();
          if (msg1.status == "1") {
            $scope.subcategories = msg1.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.fetch_all_product = function () {
      $.ajax({
        url: $scope.dirlocation + "api/fetch_all_product",
        type: "GET",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
        async: true,
        cache: false,
        contentType: "application/json",
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (result2) {
          var response2 = JSON.stringify(result2);
          var parsed2 = JSON.parse(response2);
          var msg2 = angular.fromJson(parsed2);
          console.log(msg2);

          $(".loader").hide();
          if (msg2.status == "1") {
            $scope.products = msg2.data;

            $scope.$apply();

            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.fetch_product_by_term = function () {
      var formData = new FormData($("#fetch_product_by_term")[0]);
      $.ajax({
        url: $scope.dirlocation + "api/fetch_product_by_term",
        type: "POST",
        headers: { "gnice-authenticate": "gnice-web" },
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        transformRequest: angular.identity,
        enctype: "multipart/form-data",
        processData: false,
        success: function (result3) {
          alert(result3);
          var response3 = JSON.stringify(result3);
          var parsed3 = JSON.parse(response3);
          var msg3 = angular.fromJson(response3);
          console.log(msg3);
          $(".loader").hide();
          if (msg3.status == "1") {
            alert(msg3);
            console.log(msg3.data.image);
            $scope.singleUser = msg3.data;

            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.fetch_single_product = function () {
      var url = window.location.href;
      var split_url = url.split("/").pop();
      if (split_url) {
        $.ajax({
          url: $scope.dirlocation + "api/fetch_single_product?id=" + split_url,
          type: "GET",
          async: true,
          cache: false,
          contentType: false,
          headers: { "gnice-authenticate": "gnice-web" },
          processData: false,
          success: function (result3) {
            //alert(result3);
            var response3 = JSON.stringify(result3);
            var parsed3 = JSON.parse(response3);
            var msg3 = angular.fromJson(parsed3);

            $(".loader").hide();
            if (msg3.status == "1") {
              $scope.product = msg3.data;
              $scope.product_image = $scope.split_image($scope.product.image);
              $scope.fetch_related_products();
              $scope.$apply();
            }
          },
        });
      }
    };

    $scope.fetch_related_products = function () {
      $.ajax({
        url:
          $scope.dirlocation +
          "api/fetch_related_products?sub_cat_id=" +
          $scope.product.sub_category +
          "&brand=" +
          $scope.product.brand +
          "&product_code=" +
          $scope.product.product_code,
        type: "GET",
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (result7) {
          var response7 = JSON.stringify(result7);
          var parsed7 = JSON.parse(response7);
          var msg7 = angular.fromJson(parsed7);
          $(".loader").hide();
          if (msg7.status == "1") {
            $scope.relatedProducts = msg7.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.fetch_all_product_sub_category = function () {
      $.ajax({
        url:
          $scope.dirlocation +
          "api/fetch_all_product_sub_category?id=" +
          $localStorage.valueToShare4,
        type: "GET",

        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),

        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (result7) {
          //alert(result7);
          var response7 = JSON.stringify(result7);
          var parsed7 = JSON.parse(response7);
          var msg7 = angular.fromJson(response7);
          console.log(msg7);
          //alert(msg7);
          $(".loader").hide();
          if (msg7.status == "1") {
            $scope.allSubProducts = msg7.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.fetch_all_product_category = function () {
      $.ajax({
        url:
          $scope.dirlocation +
          "api/fetch_all_product_category?id=" +
          $localStorage.valueToShares,
        type: "GET",

        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),

        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (response7) {
          // alert(response7);
          var responses7 = JSON.stringify(response7);
          var parsed7 = JSON.parse(responses7);
          var data7 = angular.fromJson(responses7);
          console.log(data7);
          $(".loader").hide();
          if (data7.status == "1") {
            $scope.allCatProducts = data7.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.fetch_all_sub_category = function () {
      $.ajax({
        url:
          $scope.dirlocation +
          "api/fetch_all_sub_category?id=" +
          $localStorage.valueToShares,
        type: "GET",
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": "gnice-web" },
        processData: false,
        success: function (response7) {
          // alert(response7);
          var responses7 = JSON.stringify(response7);
          var parsed7 = JSON.parse(responses7);
          var data7 = angular.fromJson(parsed7);
          console.log(data7);
          $(".loader").hide();
          if (data7.status == "1") {
            $scope.allSubs = data7.data;
            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };

    $scope.fetch_required_table = function () {
      $.ajax({
        url: $scope.dirlocation + "api/fetch_required_table",
        type: "GET",
        //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),

        async: true,
        cache: false,
        contentType: false,
        enctype: "multipart/form-data",
        headers: { "gnice-authenticate": "gnice-web" },
        crossDomain: true,
        processData: false,
        success: function (answer) {
          //alert(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(response);

          if (msg.status == "1") {
            $scope.save_json();
            console.log(msg.data);
            $scope.requiredState = msg.data.states;
            $scope.requiredPhone = msg.data.phone_makes;
            $scope.requiredCar = msg.data.car_makes;
            $scope.requiredProperty = msg.data.property_types;
            $scope.requiredCondition = msg.data.conditions;

            $scope.$apply();
            //alert(JSON.stringify($scope.categories));
          }
        },
      });
    };
  },
]);
