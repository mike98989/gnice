///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("packagesController", [
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
    // $(".loader").show();
    $(".result").hide();
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

    $scope.show_textinput = function (id) {
      $(".title_" + id).toggle();
      $(".content_" + id).toggle();
      $(".body_" + id).toggle();
      $(".button_save_" + id).toggle();
      $(".button_edit_" + id).toggle();
    };
    // $scope.show_textinput = function (id) {
    //   $(".title_" + id).show();
    //   $(".content_" + id).show();
    //   $(".body_" + id).hide();
    //   $(".button_save_" + id).show();
    //   $(".button_edit_" + id).hide();
    // };

    $scope.get_all_account_packages = function () {
      $(".loader").show();
      $(".result").hide();
      // alert("got here");
      // alert(JSON.stringify($scope.admin_data.email));
      $.ajax({
        url: $scope.dirlocation + "adminapi/get_account_packages",
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
          // alert(JSON.stringify(result));
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          console.log(JSON.stringify(msg.data));
          if (msg.status == "1") {
            $scope.all_packages = msg.data;
            $(".result").html(msg.message);
            $(".result").show();
            $scope.$apply();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };

    $scope.enable_or_disable = function (code, user, index) {
      var conf = confirm(
        "DO YOU WANT DISABLE/ENABLE THIS USER '" + user.fullname + "'?"
      );
      // alert(index);
      if (conf) {
        $(".loader2_" + user.fullname).show();
        var formData = new FormData();
        formData.append("status", code);
        formData.append("seller_id", user.seller_id);
        $.ajax({
          url: $scope.dirlocation + "adminapi/disable_enable_account",
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
            $(".loader2_" + user.id).hide();
            if (msg.status == "1") {
              alert(index, code);
              // all_users[index].status = code;
              user.status = code;
              $scope.$apply();
              $(".result").show();
            }
          },
        });
      }
    };
    $scope.edit_package_content = function (id, index) {
      alert(index);

      //$(".loader").show();
      var formData = new FormData($("#edit_package_content_" + id)[0]);
      $.ajax({
        url: $scope.dirlocation + "adminapi/update_package_content",
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
            $(".result").show();
            console.log($scope.all_packages[index]);
            $scope.all_packages[index] = msg.data;
            // $scope.$apply();
            // $scope.get_all_account_packages();
            // $(".result").hide();
          } else {
            $(".loader").hide();
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };

    $scope.toggle_package_status = function (code, info) {
      // $(".loader" + sub.title).show();
      var formData = new FormData();

      formData.append("status", code);
      formData.append("id", info.package_id);

      console.table(code, info);
      // return;
      $.ajax({
        url: $scope.dirlocation + "adminapi/toggle_package_status",
        data: formData,
        type: "POST",
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (result) {
          console.log(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          if (msg.status == "1") {
            info.status = code;
            $scope.$apply();
            $(".result").html(msg.message);
            $(".result").show();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };
    $scope.toggle_package_content_status = function (code, info) {
      var formData = new FormData();
      // $(".loader" + sub.title).show();
      formData.append("status", code);
      formData.append("id", info.content_id);

      console.table(code, info);
      $.ajax({
        url: $scope.dirlocation + "adminapi/toggle_package_content_status",
        data: formData,
        type: "POST",
        async: true,
        cache: false,
        contentType: false,
        headers: { "gnice-authenticate": $scope.admin_token },
        processData: false,
        success: function (result) {
          console.log(result);
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          if (msg.status == "1") {
            info.status = code;
            $scope.$apply();
            $(".result").html(msg.message);
            $(".result").show();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };

    $scope.enable_disable_package_content = function (code, sub) {
      // $(".loader" + sub.title).show();
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
          $(".loader2_" + sub.id).hide();
          if (msg.status == "1") {
            sub.status = code;
            $scope.$apply();
            $(".result").show();
          }
        },
      });
    };
  },
]);
