///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("adminController", [
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
    $scope.pageSize = 10;
    $scope.admin_data = $localStorage.user_data;
    $scope.admin_token = $localStorage.user_token;
    // $scope.admin_privilege = $localStorage.user_data.privilege;
    $scope.normal = 1;
    $scope.advance = 2;
    $scope.ultra = 3;

    setTimeout(function () {
      $scope.$apply();
    }, 0);

    // $scope.get_admin_privilege = function () {
    //   $scope.admin_data;
    // };

    $scope.get_all_admins = function () {
      $(".loader").show();
      $(".result").hide();
      $.ajax({
        url: $scope.dirlocation + "adminapi/get_all_admins",
        type: "GET",
        async: true,
        cache: false,
        contentType: false,
        headers: {
          "gnice-authenticate":
            $scope.admin_token + ":email:" + $scope.admin_data.email,
        },
        processData: false,
        success: function (result) {
          // console.log(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          if (msg.status == "1") {
            $scope.all_admins = msg.data;
            $scope.$apply();
            // $(".result").html(msg.message);
            // $(".result").show();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };
    $scope.enable_or_disable_admin = function (code, admin, $index) {
      $(".loader" + admin.fullname).show();
      var formData = new FormData();

      formData.append("status", code);
      formData.append("account_id", admin.id);
      $.ajax({
        url: $scope.dirlocation + "adminapi/disable_enable_admin_account",
        data: formData,
        type: "POST",
        async: true,
        cache: false,
        contentType: false,
        headers: {
          "gnice-authenticate":
            $scope.admin_token + ":privilege:" + $scope.admin_data.privilege,
        },
        processData: false,
        success: function (result) {
          console.log(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader2_" + admin.id).hide();
          if (msg.status == "1") {
            admin.status = code;
            $(".result").addClass("alert-success");
            $(".result").html(msg.message);
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
            }, 3000);
          } else {
            $(".result").html(msg.message);
            $(".result").addClass("alert-danger");
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
            }, 3000);
          }
        },
      });
    };

    $scope.toggle_form = function (id, index) {
      $(".form_inverse_" + id).toggle(500);
      $(".form_" + id).toggle(500);
    };
    $scope.toggle_password_form = function () {
      $(".password_form_inverse").toggle(500);
      $(".password_form").toggle(500);
    };

    $scope.create_new_admin = function () {
      var formData = new FormData($("#create_new_admin_form")[0]);

      $.ajax({
        url: $scope.dirlocation + "adminauth/create_new_admin_admin",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (answer) {
          // console.log(answer);
          // // return;
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          if (msg.status == "1") {
            $scope.all_admins = msg.data;
            $(".result").addClass("alert-success");
            $(".result").html(msg.message);
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
            }, 3000);
            $("#create_new_admin_form")[0].reset();
          } else {
            $(".loader").hide();
            $(".result").addClass("alert-danger");
            $(".result").html(msg.message);
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
            }, 3000);
          }
        },
      });
    };
    $scope.update_admin_privilege = function (id) {
      $(".loader").show();
      var formData = new FormData($("#update_admin_privilege_form_" + id)[0]);
      $.ajax({
        url: $scope.dirlocation + "adminapi/update_admin_privilege",
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
            $(".result").addClass("alert-success");
            $(".result").html(msg.message);
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
              $(".result").removeClass("alert-success");
            }, 3000);
            $("#update_admin_privilege_form_" + id)[0].reset();
          } else {
            $(".result").addClass("alert-danger");
            $(".result").html(msg.message);
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").removeClass("alert-danger");
              $(".result").hide("500");
            }, 3000);
          }
        },
      });
    };
    $scope.change_admin_password = function () {
      var formData = new FormData($("#change_password")[0]);
      $.ajax({
        url: $scope.dirlocation + "adminauth/change_admin_password",
        type: "POST",
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (answer) {
          console.log(answer);
          // return;
          var response = JSON.stringify(answer);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          if (msg.status == "1") {
            $(".result").addClass("alert-success");
            $(".result").html(msg.message);
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
            }, 3000);
            $scope.toggle_password_form();
            $("#create_new_admin_form")[0].reset();
          } else {
            $(".loader").hide();
            $(".result").addClass("alert-danger");
            $(".result").html(msg.message);
            $scope.$apply();
            $(".result").show(500);
            setTimeout(() => {
              $(".result").hide("500");
            }, 3000);
          }
        },
      });
    };
    $scope.clear_storage = function () {
      $localStorage["fullname_checked"] = false;
      window.location.reload();
    };
  },
]);
