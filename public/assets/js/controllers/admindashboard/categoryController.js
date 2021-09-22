///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("categoryController", [
  "$scope",
  "$sce",
  "$http",
  "infogathering",
  "$routeParams",
  "$localStorage",
  "$sessionStorage",
  function (
    $scope,
    $sce,
    $http,
    datagrab,
    $routeParams,
    $localStorage,
    $sessionStorage
  ) {
    $scope.fieldcounter = 1;
    //$('.loader').show();
    var url = window.location.href;
    if (url.indexOf("#") > 1) {
      var page = window.location.href.split("#");
      var pager = page[1].split("=").pop();

      if (
        pager == "" ||
        pager == "undefined" ||
        pager == null ||
        pager == "0"
      ) {
        pager = "1";
      }
    } else {
      pager = "1";
    }

    $scope.dirlocation = datagrab.completeUrlLocation;
    $scope.currentPage = pager;
    $scope.pageSize = 5;
    $scope.admin_data = $localStorage.user_data;
    $scope.admin_token = $localStorage.user_token;
    setTimeout(function () {
      $scope.$apply();
    }, 0);

    $scope.toggle_form = function (id) {
      $(".form_" + id).toggle(500);
      $(".btn_" + id).toggle(500);
    };

    $scope.loader_control = function(e){
      $(e).hide(1000);
    };

    $scope.get_all_cat_and_sub_cat = function () {
      $("#category_loader").show();
      $(".result").hide();

      $.ajax({
        url: $scope.dirlocation + "adminapi/get_all_cat_and_sub_cat",
        type: "GET",
        async: true,
        cache: false,
        contentType: false,
        headers: {
          "gnice-authenticate": "gnice-web",
        },
        processData: false,
        success: function (result) {
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $scope.loader_control('#category_loader');
         
          if (msg.status == "1") {
            $scope.all_cat_and_sub = msg.data;

            $scope.$apply();
            $(".result").hide();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };

    $scope.add_new_category = function () {
      $("#add_cat_loader").show();
      var formData = new FormData($("#addCategory")[0]);
      $.ajax({
        url: $scope.dirlocation + "adminapi/add_category",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (answer) {
          // alert(JSON.stringify(answer));
          // console.log(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $scope.loader_control('#add_cat_loader');
          if (msg.status == "1") {
            $scope.get_all_cat_and_sub_cat();
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
            $("#addCategory")[0].reset();
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };
    $scope.update_category = function (id) {
      $(".edit_"+ id).show();
      $(".icon_"+ id).hide();
      var formData = new FormData($("#updateCategory")[0]);
      $.ajax({
        url: $scope.dirlocation + "adminapi/update_category",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (answer) {
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          // console.log(JSON.stringify(msg));
          $scope.loader_control('.edit_'+ id);
          $(".icon_"+ id).hide();
          if (msg.status == "1") {
            $scope.get_all_cat_and_sub_cat();
            $scope.$apply();
           
            $(".result").html(msg.message);
            $(".result").show();
            $("#updateCategory")[0].reset();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };
    $scope.update_sub_category = function (id, index) {
      $(".sub_edit_loader_"+ id).show();
      $(".icon_"+ id).hide();
      var formData = new FormData($("#update_sub_category_" + id)[0]);
      $.ajax({
        url: $scope.dirlocation + "adminapi/update_sub_category",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (answer) {
          console.log(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".sub_edit_loader_"+ id).hide(500);
          $(".icon_"+ id).show(500);
          if (msg.status == "1") {
            console.log(msg.message);
            // $scope.all_cat_and_sub[index] = msg.data;
            // $scope.$apply();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
            $("#update_sub_category_" + id)[0].reset();
          } else {
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
          }
        },
      });
    };
    $scope.add_new_sub_category = function () {
      $(".add_sub_cat_loader").show();
      var formData = new FormData($("#addSubCategory")[0]);

      $.ajax({
        url: $scope.dirlocation + "adminapi/add_sub_category",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (answer) {
        
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".add_sub_cat_loader").hide(500);
          if (msg.status == "1") {
            $scope.get_all_cat_and_sub_cat();
            $scope.$apply();
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
            $("#addSubCategory")[0].reset();
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
          }
        },
      });
    };

    
    $scope.enable_disable_sub = function (code, sub) {
      $('.sub_loader_'+ sub.sub_id).show();
      $('.icon_'+ sub.sub_id).hide();
      var formData = new FormData();

      formData.append("status", code);
      formData.append("sub_id", sub.sub_id);
      $.ajax({
        url: $scope.dirlocation + "adminapi/disable_enable_sub_category",
        data: formData,
        type: "POST",
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (result) {
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $scope.loader_control('.sub_loader_'+ sub.sub_id);
          $('.icon_'+ sub.sub_id).show();
          if (msg.status == "1") {
            sub.status = code;
            $scope.$apply();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
          } else {
    
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
          }
        },
      });
    };
    $scope.enable_or_disable_cat = function (code, cat) {
      $(".cat_loader_"+ cat.id).show(1000);
      $(".icon_"+ cat.id).hide(1000);
      // alert("#cat_loader_"+ cat.id);
      
      var formData = new FormData();
      // alert('hello');
      // return;

      formData.append("status", code);
      formData.append("category_id", cat.id);
      $.ajax({
        url: $scope.dirlocation + "adminapi/disable_enable_category",
        data: formData,
        type: "POST",
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (result) {
          // console.log(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $scope.loader_control('.cat_loader_'+ cat.id);
          $(".icon_"+ cat.id).show();
          if (msg.status == "1") {
            cat.status = code;
            $scope.$apply();

            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
          }
        },
      });
    };
  },
]);
