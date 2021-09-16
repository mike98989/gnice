///////////// THIS IS THE BANNER CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("bannerController", [
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

    //* Start

    $scope.fetch_all_banners = function () {
      $(".loader").show();
      $(".result").hide();
      $.ajax({
        url: $scope.dirlocation + "adminapi/fetch_all_banners",
        type: "GET",
        async: true,
        cache: false,
        contentType: false,
        headers: {
          "gnice-authenticate": $scope.admin_token,
        },
        processData: false,
        success: function (result) {
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          if (msg.status == "1") {
            $scope.all_banners = msg.data;
            $scope.$apply();
            $(".loader").hide();
            // $(".result").html(msg.message);
            // $(".result").show();
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
    $scope.create_new_banner = function () {
      $(".loader").show();
      var formData = new FormData($("#create_new_banner")[0]);
      $.ajax({
        url: $scope.dirlocation + "adminapi/create_new_banner",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (answer) {
          // console.log(answer);
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          if (msg.status == "1") {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").addClass("alert alert-info");
            $(".result").show(500);

            $scope.fetch_all_banners();
            $scope.$apply();
            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert alert-info");
            }, 3000);
            $("#addCategory")[0].reset();
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
    $scope.enable_or_disable_banner = function (code, banner, $index) {
      $(".loader").show();
      var formData = new FormData();

      formData.append("status", code);
      formData.append("banner_id", banner.id);
      formData.append("banner_type", banner.type);
      $.ajax({
        url: $scope.dirlocation + "adminapi/disable_enable_banner",
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
          $(".loader").hide();
          if (msg.status == "1") {
            banner.status = code;
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

    $scope.update_banner = function () {
      $(".loader").show();
      var formData = new FormData($("#update_banner")[0]);
      $.ajax({
        url: $scope.dirlocation + "adminapi/update_banner",
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
          $(".loader").hide();
          if (msg.status == "1") {
            $scope.fetch_all_banners();
            $scope.$apply();
            $(".loader").hide();
            $(".result").html(msg.message);
            alert(msg.message);
            $(".result").show();
            $("#updateCategory")[0].reset();
          } else {
            $scope.get_all_cat_and_sub_cat();
            alert(msg.message);
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };
    // $scope.update_sub_category = function (id, index) {
    //   $(".loader").show();
    //   var formData = new FormData($("#update_sub_category_" + id)[0]);
    //   $.ajax({
    //     url: $scope.dirlocation + "adminapi/update_sub_category",
    //     type: "POST",
    //     data: formData,
    //     async: true,
    //     cache: false,
    //     contentType: false,
    //     headers: { "gnice-authenticate": $scope.admin_token },
    //     processData: false,
    //     success: function (answer) {
    //       console.log(answer);
    //       var response = JSON.stringify(answer);
    //       var parsed = JSON.parse(response);
    //       var msg = angular.fromJson(parsed);
    //       $(".loader").hide();
    //       if (msg.status == "1") {
    //         $(".loader").hide();
    //         $(".result").html(msg.message);
    //         $(".result").addClass("alert-success");
    //         $(".result").show();
    //         // console.log($scope.all_packages[index]);
    //         $scope.all_cat_and_sub[index] = msg.data;
    //         // $scope.$apply();
    //         // $scope.get_all_account_packages();
    //         // $(".result").hide();
    //         setTimeout(() => {
    //           // $(".result").html(msg.message);

    //           $(".result").hide("500");
    //         }, 3000);
    //         $("#update_sub_category_" + id)[0].reset();
    //       } else {
    //         $(".loader").hide();
    //         $(".result").addClass("alert-danger");
    //         $(".result").html(msg.message);
    //         $(".result").show();
    //       }
    //     },
    //   });
    // };
    // $scope.add_new_sub_category = function () {
    //   $(".loader").show();
    //   var formData = new FormData($("#addSubCategory")[0]);

    //   $.ajax({
    //     url: $scope.dirlocation + "adminapi/add_sub_category",
    //     type: "POST",
    //     data: formData,
    //     async: true,
    //     cache: false,
    //     contentType: false,
    //     headers: { "gnice-authenticate": $scope.admin_token },
    //     processData: false,
    //     success: function (answer) {
    //       alert(JSON.stringify(answer));
    //       // console.log(answer);
    //       var response = JSON.stringify(answer);
    //       var parsed = JSON.parse(response);
    //       var msg = angular.fromJson(parsed);
    //       $(".loader").hide();
    //       if (msg.status == "1") {
    //         $scope.get_all_cat_and_sub_cat();
    //         $(".loader").hide();
    //         $(".result").html(msg.message);
    //         $(".result").show();
    //         $("#addSubCategory")[0].reset();
    //       } else {
    //         $(".loader").hide();
    //         $(".result").html(msg.message);
    //         $(".result").show();
    //         //alert(msg.message);
    //       }
    //     },
    //   });
    // };

    // // TODO: check code below
    // $scope.enable_or_disable = function (code, user, index) {
    //   var conf = confirm(
    //     "DO YOU WANT DISABLE/ENABLE THIS USER '" + user.fullname + "'?"
    //   );
    //   // alert(index);
    //   if (conf) {
    //     $(".loader2_" + user.fullname).show();
    //     var formData = new FormData();
    //     formData.append("status", code);
    //     formData.append("seller_id", user.seller_id);
    //     $.ajax({
    //       url: $scope.dirlocation + "adminapi/disable_enable_account",
    //       data: formData,
    //       type: "POST",
    //       async: true,
    //       cache: false,
    //       contentType: false,
    //       headers: { "gnice-authenticate": $scope.admin_token },
    //       processData: false,
    //       success: function (result) {
    //         var response = JSON.stringify(result);
    //         var parsed = JSON.parse(response);
    //         var msg = angular.fromJson(parsed);
    //         $(".loader2_" + user.id).hide();
    //         if (msg.status == "1") {
    //           alert(index, code);
    //           // all_users[index].status = code;
    //           user.status = code;
    //           $scope.$apply();
    //           $(".result").html(msg.message);
    //           $(".result").show();
    //         }
    //       },
    //     });
    //   }
    // };
    // $scope.enable_disable_sub = function (code, sub) {
    //   // $(".loader" + sub.title).show();
    //   var formData = new FormData();

    //   formData.append("status", code);
    //   formData.append("sub_id", sub.sub_id);
    //   $.ajax({
    //     url: $scope.dirlocation + "adminapi/disable_enable_sub_category",
    //     data: formData,
    //     type: "POST",
    //     async: true,
    //     cache: false,
    //     contentType: false,
    //     headers: { "gnice-authenticate": $scope.admin_token },
    //     processData: false,
    //     success: function (result) {
    //       var response = JSON.stringify(result);
    //       var parsed = JSON.parse(response);
    //       var msg = angular.fromJson(parsed);
    //       $(".loader2_" + sub.id).hide();
    //       if (msg.status == "1") {
    //         sub.status = code;
    //         $scope.$apply();
    //         $(".result").html(msg.message);
    //         $(".result").show();
    //       }
    //     },
    //   });
    // };
  },
]);
