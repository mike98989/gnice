///////////// THIS IS THE INDEXPAGE CONTROLLER///////
///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
/////////////////////////

module.controller("usersController", [
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
    $scope.pageSize = 9;
    $scope.admin_data = $localStorage.user_data;
    $scope.admin_token = $localStorage.user_token;
    setTimeout(function () {
      $scope.$apply();
    }, 0);

    $scope.get_all_users = function () {
      $(".loader").show();
      $(".result").hide();
      // alert("got here");
      // alert(JSON.stringify($scope.admin_data.email));
      $.ajax({
        url: $scope.dirlocation + "adminapi/get_all_users",
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
          alert(JSON.stringify(result));
          var response = JSON.stringify(result);
          var parsed = JSON.parse(response);
          var msg = angular.fromJson(parsed);
          $(".loader").hide();
          //alert(JSON.stringify(msg.data));
          if (msg.status == "1") {
            $scope.all_users = msg.data;
            $scope.$apply();
            $(".result").show();
          } else {
            $(".result").html(msg.message);
            $(".result").show();
          }
        },
      });
    };

    $scope.enable_or_disable = function (code, account, index) {
      var conf = confirm(
        "DO YOU WANT DISABLE/ENABLE THIS USER '" + account.fullname + "'?"
      );
      if (conf) {
        $(".loader2_" + account.fullname).show();
        $.ajax({
          url:
            $scope.dirlocation +
            "adminapi/enable_user?seller_id=" +
            account.seller_id,
          async: true,
          cache: false,
          contentType: false,
          headers: { "gnice-authenticate": $scope.admin_token },
          processData: false,
          success: function (result) {
            alert(result);
            var response = JSON.stringify(result);
            var parsed = JSON.parse(response);
            var msg = angular.fromJson(parsed);
            $(".loader2_" + account.id).hide();
            if (msg.status == "1") {
              alert(msg.message);
              $scope.products.splice(index, 1);
              $scope.$apply();
            }
          },
        });
      }
    };
  },
]);
